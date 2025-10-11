<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMarkController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentAuthController; 
use App\Http\Controllers\RoutineController;


Route::get('/', function () {
    return view('welcome');
});

// ======================
// Admin Routes
// ======================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login'); // Optional admin login
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/classes', [AdminController::class, 'classes'])->name('admin.classes');
    Route::get('/marks', [AdminController::class, 'marks'])->name('admin.marks');
    Route::get('/attendance', [AdminController::class, 'attendance'])->name('admin.attendance');
    Route::get('/routine/{class}/edit', [RoutineController::class, 'edit'])->name('admin.routine.edit');
    //Route::post('/routine/{class}/update', [RoutineController::class, 'update'])->name('admin.routine.update');
    //Route::get('/routine/create', [RoutineController::class, 'create'])->name('admin.routine.create');
    //Route::post('/routine/store', [RoutineController::class, 'store'])->name('admin.routine.store');
    //Route::post('/routine/{class}/update', [RoutineController::class, 'update'])->name('admin.routine.update');
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
    Route::get('/marks', [StudentMarkController::class, 'index'])->name('student.marks');
    Route::get('/attendance', [StudentAttendanceController::class, 'index'])->name('student.attendance');
});
