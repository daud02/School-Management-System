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
        $classes = Classes::all();
        return view('admin.attendance', compact('classes'));
    }

    /**
     * Show the attendance marking page for a specific class.
     */
    public function markAttendance($classId)
{
    // find the class
     $class =Classes::findOrFail($classId);
     $attendance=Attendance::all();
       $date = Carbon::now()->toDateString(); 

    // get all students (you can filter by class if needed)
    $students = Student::where('class', $class->name . $class->section)->get();

    // current date
   

    // pass variables to view
    return view('admin.attend', compact('class', 'students','date','attendance'));
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