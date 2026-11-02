<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use PDO;
use Exception;

class SystemToolsController extends Controller
{
    /**
     * Show the System Tools / Maintenance & Installer Page
     */
    public function index()
    {
        $requirements = $this->checkServerRequirements();
        $dbStatus = $this->checkDatabaseConnection();
        $tableCount = $dbStatus['connected'] ? $this->getTableCount() : 0;
        
        $envConfig = [
            'db_host' => env('DB_HOST', '127.0.0.1'),
            'db_port' => env('DB_PORT', '3306'),
            'db_database' => env('DB_DATABASE', 'smart_hospital'),
            'db_username' => env('DB_USERNAME', 'root'),
            'db_password' => env('DB_PASSWORD', ''),
        ];

        return view('admin.system_tools.index', compact('requirements', 'dbStatus', 'tableCount', 'envConfig'));
    }

    /**
     * Test and Save Database Connection, Creating Database if it doesn't exist
     */
    public function setupDatabase(Request $request)
    {
        $request->validate([
            'db_host' => 'required',
            'db_port' => 'required',
            'db_database' => 'required',
            'db_username' => 'required',
        ]);

        $host = $request->input('db_host');
        $port = $request->input('db_port');
        $database = $request->input('db_database');
        $username = $request->input('db_username');
        $password = $request->input('db_password') ?? '';

        try {
            // Step 1: Connect to MySQL server without database
            $dsn = "mysql:host={$host};port={$port}";
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]);

            // Step 2: Create database if it does not exist
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

            // Step 3: Write to .env file
            $this->updateEnvFile([
                'DB_HOST' => $host,
                'DB_PORT' => $port,
                'DB_DATABASE' => $database,
                'DB_USERNAME' => $username,
                'DB_PASSWORD' => $password,
            ]);

            // Clear configuration cache
            Artisan::call('config:clear');

            return response()->json([
                'success' => true,
                'message' => "Database `{$database}` checked/created successfully and .env updated!"
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Connection failed: " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Import full Smart Hospital database.sql
     */
    public function importDatabase(Request $request)
    {
        $sqlPath = database_path('sql/database.sql');

        if (!File::exists($sqlPath)) {
            return response()->json([
                'success' => false,
                'message' => "database.sql file not found in database/sql/ directory."
            ], 404);
        }

        try {
            ini_set('memory_limit', '1024M');
            set_time_limit(600);

            // Re-read .env config
            $host = env('DB_HOST', '127.0.0.1');
            $port = env('DB_PORT', '3306');
            $database = env('DB_DATABASE', 'smart_hospital');
            $username = env('DB_USERNAME', 'root');
            $password = env('DB_PASSWORD', '');

            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);

            $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

            // Read SQL file and execute
            $sql = File::get($sqlPath);
            $pdo->exec($sql);

            $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

            // Check if Super Admin exists in staff table, or create default
            $adminEmail = $request->input('admin_email', 'admin@smart-hospital.com');
            $adminPass = $request->input('admin_password', 'admin123');

            $stmt = $pdo->prepare("SELECT id FROM staff WHERE email = ? LIMIT 1");
            $stmt->execute([$adminEmail]);
            $staff = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($staff) {
                $updateStmt = $pdo->prepare("UPDATE staff SET password = ? WHERE id = ?");
                $updateStmt->execute([Hash::make($adminPass), $staff['id']]);
            } else {
                $insertStmt = $pdo->prepare("INSERT INTO staff (employee_id, name, surname, email, password, is_active, lang_id) VALUES (?, ?, ?, ?, ?, 1, 1)");
                $insertStmt->execute(['9001', 'Super', 'Admin', $adminEmail, Hash::make($adminPass)]);
                $staffId = $pdo->lastInsertId();

                // Attach Super Admin role (role_id = 7)
                $roleStmt = $pdo->prepare("INSERT INTO staff_roles (staff_id, role_id) VALUES (?, 7)");
                $roleStmt->execute([$staffId]);
            }

            $tableCount = $this->getTableCount();

            return response()->json([
                'success' => true,
                'message' => "Database imported successfully! Total {$tableCount} tables created.",
                'table_count' => $tableCount,
                'admin_email' => $adminEmail,
                'admin_password' => $adminPass,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Database Import Error: " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Run Artisan Command via Web GUI
     */
    public function runCommand(Request $request)
    {
        $command = trim($request->input('command', ''));

        if (empty($command)) {
            return response()->json(['success' => false, 'output' => 'Command cannot be empty.'], 400);
        }

        // Whitelist safe commands
        $allowedCommands = [
            'storage:link',
            'optimize:clear',
            'cache:clear',
            'config:clear',
            'config:cache',
            'route:clear',
            'route:cache',
            'view:clear',
            'view:cache',
            'key:generate',
            'migrate',
            'migrate:status',
            'migrate:fresh',
            'db:seed',
            'about',
            'list',
        ];

        $cmdParts = explode(' ', $command);
        $baseCmd = $cmdParts[0];

        if (!in_array($baseCmd, $allowedCommands)) {
            return response()->json([
                'success' => false,
                'output' => "Command '{$baseCmd}' is not allowed for security reasons."
            ], 403);
        }

        try {
            $params = [];
            if ($baseCmd === 'key:generate' || $baseCmd === 'migrate' || $baseCmd === 'migrate:fresh') {
                $params['--force'] = true;
            }

            $exitCode = Artisan::call($baseCmd, $params);
            $output = Artisan::output();

            if (empty(trim($output))) {
                $output = "Command 'php artisan {$command}' executed successfully with exit code: {$exitCode}";
            }

            return response()->json([
                'success' => $exitCode === 0,
                'command' => 'php artisan ' . $command,
                'output' => $output,
                'exit_code' => $exitCode,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'command' => 'php artisan ' . $command,
                'output' => "Error executing command: " . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update .env file safely
     */
    private function updateEnvFile(array $data)
    {
        $envPath = base_path('.env');
        if (!File::exists($envPath)) {
            File::copy(base_path('.env.example'), $envPath);
        }

        $content = File::get($envPath);

        foreach ($data as $key => $value) {
            // Handle values with spaces or special characters
            if (preg_match('/\s/', $value) || strpos($value, '#') !== false) {
                $value = '"' . $value . '"';
            }

            if (preg_match("/^{$key}=/m", $content)) {
                $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
            } else {
                $content .= "\n{$key}={$value}";
            }
        }

        File::put($envPath, $content);
    }

    private function checkServerRequirements()
    {
        return [
            'php_version' => [
                'name' => 'PHP Version (>= 8.1.0)',
                'current' => phpversion(),
                'passed' => version_compare(phpversion(), '8.1.0', '>='),
            ],
            'pdo_mysql' => [
                'name' => 'PDO MySQL Extension',
                'current' => extension_loaded('pdo_mysql') ? 'Enabled' : 'Disabled',
                'passed' => extension_loaded('pdo_mysql'),
            ],
            'openssl' => [
                'name' => 'OpenSSL Extension',
                'current' => extension_loaded('openssl') ? 'Enabled' : 'Disabled',
                'passed' => extension_loaded('openssl'),
            ],
            'mbstring' => [
                'name' => 'Mbstring Extension',
                'current' => extension_loaded('mbstring') ? 'Enabled' : 'Disabled',
                'passed' => extension_loaded('mbstring'),
            ],
            'tokenizer' => [
                'name' => 'Tokenizer Extension',
                'current' => extension_loaded('tokenizer') ? 'Enabled' : 'Disabled',
                'passed' => extension_loaded('tokenizer'),
            ],
            'curl' => [
                'name' => 'cURL Extension',
                'current' => extension_loaded('curl') ? 'Enabled' : 'Disabled',
                'passed' => extension_loaded('curl'),
            ],
            'storage_writable' => [
                'name' => 'Storage Directory Writable',
                'current' => is_writable(storage_path()) ? 'Writable' : 'Not Writable',
                'passed' => is_writable(storage_path()),
            ],
            'env_writable' => [
                'name' => '.env File Writable',
                'current' => is_writable(base_path('.env')) || !File::exists(base_path('.env')) ? 'Writable' : 'Not Writable',
                'passed' => is_writable(base_path('.env')) || !File::exists(base_path('.env')),
            ],
        ];
    }

    private function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return [
                'connected' => true,
                'message' => 'Connected successfully to `' . env('DB_DATABASE') . '`'
            ];
        } catch (Exception $e) {
            return [
                'connected' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function getTableCount()
    {
        try {
            $database = env('DB_DATABASE');
            $result = DB::select("SELECT COUNT(*) as table_count FROM information_schema.tables WHERE table_schema = ?", [$database]);
            return $result[0]->table_count ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }
}
