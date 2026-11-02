<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SystemToolsController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\IpdController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PathologyController;
use App\Http\Controllers\RadiologyController;
use App\Http\Controllers\BloodBankController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes - Smart Hospital Management System (Laravel 10)
|--------------------------------------------------------------------------
*/

// Root redirect
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// System Tools & Live Web Migration / Artisan Console (Accessible directly via /install or /admin/system-tools)
Route::get('/install', [SystemToolsController::class, 'index'])->name('install');
Route::prefix('admin/system-tools')->name('system_tools.')->group(function () {
    Route::get('/', [SystemToolsController::class, 'index'])->name('index');
    Route::post('/setup-database', [SystemToolsController::class, 'setupDatabase'])->name('setup_database');
    Route::post('/import-database', [SystemToolsController::class, 'importDatabase'])->name('import_database');
    Route::post('/run-command', [SystemToolsController::class, 'runCommand'])->name('run_command');
});

// Admin Panel Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Modules
    Route::get('/opd', [OpdController::class, 'index'])->name('opd.index');
    Route::get('/ipd', [IpdController::class, 'index'])->name('ipd.index');
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');
    Route::get('/pathology', [PathologyController::class, 'index'])->name('pathology.index');
    Route::get('/radiology', [RadiologyController::class, 'index'])->name('radiology.index');
    Route::get('/blood-bank', [BloodBankController::class, 'index'])->name('blood_bank.index');
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});
