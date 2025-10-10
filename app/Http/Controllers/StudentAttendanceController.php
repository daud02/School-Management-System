<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class StudentAttendanceController extends Controller
{
    public function index()
    {
        $student_id = session('student.id'); // get logged-in student's ID from session
        // Fetch attendance records for the student
        $attendance = Attendance::where('student_id', $student_id)
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($record) {
                return [
                    'date'   => $record->date->format('Y-m-d'),        // format as YYYY-MM-DD
                    'day'    => Carbon::parse($record->date)->format('l'), // day name
                    'time'   => '08:00 AM',                            // default time
                    'status' => ucfirst($record->status),              // Present / Absent
                ];
            });

        return view('student.attendance', compact('attendance'));
    }
}
