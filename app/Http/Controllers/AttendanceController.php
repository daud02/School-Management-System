<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    /**
     * Display a listing of all classes for attendance selection.
     */
    public function index()
    {
        // Fetch all classes and convert to array format expected by the blade
        $classes = Classes::all()->map(function ($class) {
            return [
                'id' => $class->id,
                'name' => $class->name,
                'section' => $class->section,
                'students' => $class->students,
                'teacher' => $class->teacher,
            ];
        })->toArray();

        return view('admin.attendance', compact('classes'));
    }

    /**
     * Show the attendance marking page for a specific class.
     */
    public function markAttendance($classId)
    {
        // Find the class
        $classModel = Classes::findOrFail($classId);
        
        // Convert class to array format
        $class = [
            'id' => $classModel->id,
            'name' => $classModel->name,
            'section' => $classModel->section,
            'students' => $classModel->students,
            'teacher' => $classModel->teacher,
        ];
        
        // Fetch all attendance and convert to array format
        $attendance = Attendance::all()->map(function ($attend) {
            return [
                'id' => $attend->id,
                'class' => $attend->class,
                'date' => $attend->date,
                'student' => $attend->student,
                'status' => $attend->status,
            ];
        })->toArray();
        
        $date = Carbon::now()->toDateString(); 

        // Get all students and convert to array format
        $students = Student::where('class', $classModel->name . $classModel->section)
            ->get()
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'student_id' => $student->student_id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'class' => $student->class,
                    'gender' => $student->gender,
                    'date_of_birth' => $student->date_of_birth,
                    'phone' => $student->phone,
                    'address' => $student->address,
                ];
            })->toArray();

        // Pass variables to view
        return view('admin.attendance', compact('class', 'students', 'date', 'attendance'));
    }

    /**
     * Store attendance records.
     * 
     */
   
    public function store(Request $request)
    {
          $validated = $request->validate([
        'class' => 'required|string',
        'date' => 'required|date',
        
        'attendance' => 'required|array',
        'attendance.*' => 'required|in:present,absent',
    ]);

    // Loop through each student and create an attendance record
    foreach ($validated['attendance'] as $studentId => $status) {
         $student = Student::find($studentId); // get student record
        if (!$student) continue; 
        Attendance::create([
            'class' => $validated['class'],
            'date' => $validated['date'],
           'student' => $student->name,
            'status' => $status,
            
        ]);
    }

    return redirect()->route('attendance.index')->with('success', 'Attendance marked successfully!');
}}