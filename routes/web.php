<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

// Auth Routes
Route::get('/admin/login', function () {
    return view('auth.admin-login');
})->name('admin.login');

Route::get('/student/login', function () {
    return view('auth.student-login');
})->name('student.login');

// Admin/Teacher Combined Routes (Admin manages everything)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/classes', [AdminController::class, 'classes'])->name('admin.classes');
    Route::get('/marks', [AdminController::class, 'marks'])->name('admin.marks');
    Route::get('/attendance', [AdminController::class, 'attendance'])->name('admin.attendance');
});

// Student Routes
Route::prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/routine', [StudentController::class, 'routine'])->name('student.routine');
    Route::get('/marks', [StudentController::class, 'marks'])->name('student.marks');
    Route::get('/attendance', [StudentController::class, 'attendance'])->name('student.attendance');
});

