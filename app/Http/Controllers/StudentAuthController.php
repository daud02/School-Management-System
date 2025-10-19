<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAuth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.student-login');  // resources/views/auth/student-login.blade.php
    }

    /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        $request->merge([
            'email' => trim($request->email),
            'password' => trim($request->password),
        ]);
        // ✅ Validate incoming request
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        // ✅ Find student by email
        $student = StudentAuth::where('email', $request->email)->first();
        if ($student) {
            // dd([
            //     'password_from_db' => $student->password,
            //     'password_entered' => $request->password,
            //     'password_check'   => Hash::check($request->password, $student->password),
            // ]);
        }
        if ($student && Hash::check($request->password, $student->password)) {
            // Store student info in session
            $request->session()->put('student', [
                'id'         => $student->id,
                'student_id' => $student->student_id,
                'email'      => $student->email,
            ]);

            // 🔹 Redirect to dashboard with student_id in the URL
            return redirect()->route('student.dashboard')->with('success', 'Login successful!');
        }

        // ❌ If credentials are wrong
        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Remove student session
        $request->session()->forget('student');

        return redirect()->route('student.login')->with('success', 'Logged out successfully');
    }
}
