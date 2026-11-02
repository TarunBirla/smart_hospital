<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use Exception;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('staff')->check() || Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            // Attempt login via Eloquent Auth
            if (Auth::attempt($credentials, $request->has('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // Fallback: check staff directly (in case user provider wasn't registered)
            $staff = Staff::where('email', $credentials['email'])->first();
            if ($staff && Hash::check($credentials['password'], $staff->password)) {
                Auth::login($staff, $request->has('remember'));
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

        } catch (Exception $e) {
            // If DB is not connected yet, allow access to System Tools
            if (str_contains($e->getMessage(), 'Base table or view not found') || str_contains($e->getMessage(), 'Connection refused')) {
                return redirect()->route('system_tools.index')->with('error', 'Database not connected. Please setup and migrate database first.');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email address or password.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
