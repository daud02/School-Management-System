<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMarkController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentAuthController; 
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentsMarkController;
Route::get('/', function () {
    return view('welcome');
});

// ======================
// Admin Routes
// ======================


// Admin Dashboard Route
Route::get('/admin', function () {
    $stats = [
        'total_students' => \App\Models\Student::count(),
        'total_teachers' => 0, // Update this when you have teachers
        'total_classes' => \App\Models\Classes::count(),
        'total_subjects' => 5, // Update this based on your subjects
    ];
    return view('admin.dashboard', compact('stats'));
})->name('admin.dashboard');

// Student Management Routes
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::put('/students/{student_id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student_id}', [StudentController::class, 'destroy'])->name('students.destroy');

// Admin Routes (aliases for navigation)
Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students');
Route::get('/admin/classes', [ClassController::class, 'index'])->name('admin.classes');
Route::get('/admin/marks', [MarkController::class, 'index'])->name('admin.marks');
Route::get('/admin/attendance', function () {
    return redirect()->route('attendance.index');
})->name('admin.attendance');

// Class Management Routes
Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');

// Marks Management Routes
Route::get('/marks', [MarkController::class, 'index'])->name('marks.index');
Route::post('/marks', [MarkController::class, 'store'])->name('marks.store');
Route::put('/marks/{id}', [MarkController::class, 'update'])->name('marks.update');
Route::delete('/marks/{id}', [MarkController::class, 'destroy'])->name('marks.destroy');


Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/mark/{classId}', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login'); // Optional admin login
    Route::get('/routine/{class}/edit', [RoutineController::class, 'edit'])->name('admin.routine.edit');
    Route::get('/routine/create', [RoutineController::class, 'create'])->name('admin.routine.create');
    Route::post('/routine/update/{class}', [RoutineController::class, 'update'])->name('admin.routine.update');
    Route::get('/routine/edit', [RoutineController::class, 'showStaticForm'])->name('admin.routine.static');
    Route::post('/routine/edit', [RoutineController::class, 'saveStaticForm'])->name('admin.routine.static.save');
});

// ======================
// Student Routes
// ======================
Route::prefix('student')->group(function () {
    // Login routes
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login'])->name('student.login.submit');
    // Dashboard route (no student_id in path)
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/routine', [RoutineController::class, 'show'])->name('student.routine');
    Route::get('/marks', [StudentsMarkController::class, 'index'])->name('student.marks');
    Route::get('/attendance', [StudentAttendanceController::class, 'index'])->name('student.attendance');
});