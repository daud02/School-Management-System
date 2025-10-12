<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminAuth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Show the admin login form - works with current admin-login.blade.php
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    // Handle admin authentication - checks email and password from admin_auth table
    public function authenticate(Request $request)
{
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:1'
    ]);

    $email = $request->input('email');
    $password = $request->input('password');

    // Find admin
    $admin = AdminAuth::where('email', $email)->first();

    if (!$admin) {
        return back()->withErrors([
            'email' => 'No admin found with this email address.'
        ])->withInput($request->only('email'));
    }

    $passwordMatches = false;

    // ✅ Check if the stored password looks like a bcrypt hash before calling Hash::check()
    if (preg_match('/^\$2y\$/', $admin->password)) {
        // Stored password is hashed with bcrypt
        if (Hash::check($password, $admin->password)) {
            $passwordMatches = true;
        }
    } 
    // 🧩 Otherwise, compare as plain text (legacy data)
    elseif ($password === $admin->password) {
        $passwordMatches = true;

        // Auto-hash old plain text password for future logins
        $admin->password = Hash::make($password);
        $admin->save();
    }

    if ($passwordMatches) {
        // Login success
        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id,
            'admin_email' => $admin->email
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
    }

    // Invalid password
    return back()->withErrors([
        'password' => 'The password is incorrect.'
    ])->withInput($request->only('email'));
}
    // Handle admin logout
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_email']);
        return redirect()->route('admin.login');
    }

    // Check if admin is authenticated (helper method)
    public function isAuthenticated()
    {
        return session('admin_logged_in', false);
    }
}