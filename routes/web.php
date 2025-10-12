<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMarkController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentAuthController; 
use App\Http\Controllers\RoutineController;
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
    return view('welcome');
});

// ======================
// Admin Routes
// ======================


// Admin Dashboard Route
Route::get('/admin', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access the admin dashboard.'
        ]);
    }

    $stats = [
        'total_students' => \App\Models\Student::count(),
        'total_teachers' => 0, // Update this when you have teachers
        'total_classes' => \App\Models\Classes::count(),
        'total_subjects' => 5, // Update this based on your subjects
    ];
    return view('admin.dashboard', compact('stats'));
})->name('admin.dashboard');

// Student Management Routes
Route::get('/students', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(StudentController::class)->index();
})->name('students.index');
Route::post('/students', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(StudentController::class)->store(request());
})->name('students.store');
Route::put('/students/{student_id}', function ($student_id) {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(StudentController::class)->update(request(), $student_id);
})->name('students.update');
Route::delete('/students/{student_id}', function ($student_id) {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(StudentController::class)->destroy($student_id);
})->name('students.destroy');

// Admin Routes (aliases for navigation)
Route::get('/admin/students', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(StudentController::class)->index();
})->name('admin.students');
Route::get('/admin/classes', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(ClassController::class)->index();
})->name('admin.classes');
Route::get('/admin/marks', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(MarkController::class)->index();
})->name('admin.marks');
Route::get('/admin/attendance', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return redirect()->route('attendance.index');
})->name('admin.attendance');

// Class Management Routes
Route::get('/classes', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(ClassController::class)->index();
})->name('classes.index');
Route::post('/classes', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(ClassController::class)->store(request());
})->name('classes.store');
Route::put('/classes/{id}', function ($id) {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(ClassController::class)->update(request(), $id);
})->name('classes.update');
Route::delete('/classes/{id}', function ($id) {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(ClassController::class)->destroy($id);
})->name('classes.destroy');

// Marks Management Routes
Route::get('/marks', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(MarkController::class)->index();
})->name('marks.index');
Route::post('/marks', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(MarkController::class)->store(request());
})->name('marks.store');
Route::put('/marks/{id}', function ($id) {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(MarkController::class)->update(request(), $id);
})->name('marks.update');
Route::delete('/marks/{id}', function ($id) {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(MarkController::class)->destroy($id);
})->name('marks.destroy');


Route::get('/attendance', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(AttendanceController::class)->index();
})->name('attendance.index');
Route::get('/attendance/mark/{classId}', function ($classId) {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(AttendanceController::class)->markAttendance($classId);
})->name('attendance.mark');
Route::post('/attendance/store', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Please log in to access admin sections.'
        ]);
    }
    return app(AttendanceController::class)->store(request());
})->name('attendance.store');


Route::prefix('admin')->group(function () {
    // Admin Authentication Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'authenticate'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Admin Routine Routes
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
    Route::get('/marks', [StudentMarkController::class, 'index'])->name('student.marks');
    Route::get('/attendance', [StudentAttendanceController::class, 'index'])->name('student.attendance');
});