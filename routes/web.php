<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect home to students list
// Route::get('/', function () {
//     return redirect()->route('students.index');
// });

// Admin Dashboard Route
Route::get('/', function () {
    $stats = [
        'total_students' => \App\Models\Student::count(),
        'total_teachers' => 0, // Update this when you have teachers
        'total_classes' => \App\Models\Classes::count(),
        'total_subjects' => 5, // Update this based on your subjects
    ];
    return view('admin.dashboard', compact('stats'));
})->name('admin.dashboard');

// Admin Routes (aliases for navigation)
Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students');
Route::get('/admin/classes', [ClassController::class, 'index'])->name('admin.classes');
Route::get('/admin/marks', [MarkController::class, 'index'])->name('admin.marks');
Route::get('/admin/attendance', function () {
    return redirect()->route('attendance.index');
})->name('admin.attendance');

// Student Management Routes
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::put('/students/{student_id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student_id}', [StudentController::class, 'destroy'])->name('students.destroy');

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



// Route::get('/', function () {
//     return redirect()->route('admin.students');
// });

// Route::resource('students', StudentController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ClassController;

// // Classes Routes
// Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
// Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
// Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
// Route::get('/classes/{classes}/edit', [ClassController::class, 'edit'])->name('classes.edit');
// Route::put('/classes/{classes}', [ClassController::class, 'update'])->name('classes.update');
// Route::delete('/classes/{classes}', [ClassController::class, 'destroy'])->name('classes.destroy');


// use App\Http\Controllers\MarkController;
// use Illuminate\Support\Facades\Route;

// // Marks Management Routes - Using Route Model Binding
// Route::prefix('admin')->group(function () {
//     Route::get('/marks', [MarkController::class, 'index'])->name('marks.index');
//     Route::get('/marks/create', [MarkController::class, 'create'])->name('marks.create');
//     Route::post('/marks', [MarkController::class, 'store'])->name('marks.store');
//     Route::get('/marks/{marks}/edit', [MarkController::class, 'edit'])->name('marks.edit');
//     Route::put('/marks/{marks}', [MarkController::class, 'update'])->name('marks.update');
//     Route::delete('/marks/{marks}', [MarkController::class, 'destroy'])->name('marks.destroy');
// });<?php

// Attendance Routes
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/mark/{classId}', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
