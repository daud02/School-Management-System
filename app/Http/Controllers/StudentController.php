<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function dashboard()
    {
        
    $student = session('student');
    if (!$student) {
        return redirect()->route('student.login');
    }
    $studentId = $student['student_id'];

    // attendance percentage calculation
    $totalClasses = DB::table('attendances')
        ->where('student_id', $studentId)
        ->count();

    $presentCount = DB::table('attendances')
        ->where('student_id', $studentId)
        ->where('status', 'Present')
        ->count();

    $attendancePercentage = $totalClasses > 0 
        ? round(($presentCount / $totalClasses) * 100) 
        : 0;
    // Existing stats (keep hard-coded for now)
    $stats = [
        'total_subjects' => 6,
        'attendance_percentage' => $attendancePercentage,
        'pending_assignments' => 3,
        'upcoming_exams' => 2
    ];

    // Fetch marks dynamically from database
    $marks = DB::table('marks')
        ->join('subjects', 'marks.subject_code', '=', 'subjects.code')
        ->where('marks.student_id', $studentId)
        ->select('subjects.name as subject', 'marks.mark as marks', 'marks.created_at as date')
        ->get();

    // Calculate overall average
    $overallAvg = $marks->avg(fn($m) => $m->marks);

    return view('student.dashboard', compact('stats', 'marks', 'overallAvg'));
    }


    public function routine()
    {
        // Organize routine data by time slots and days
        $timeSlots = [
            '08:00 - 09:00',
            '09:00 - 10:00',
            '10:00 - 11:00',
            '11:00 - 12:00',
            '12:00 - 01:00'
        ];

        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday'];

        // Timetable data: [day][time] = [subject, teacher, room]
        $timetable = [
            'Saturday' => [
                '08:00 - 09:00' => ['subject' => 'Mathematics', 'teacher' => 'Md. Kamal Hossain', 'room' => 'Room 101'],
                '09:00 - 10:00' => ['subject' => 'English', 'teacher' => 'Farida Yasmin', 'room' => 'Room 102'],
                '10:00 - 11:00' => ['subject' => 'Science', 'teacher' => 'Dr. Abdur Rahman', 'room' => 'Lab 1'],
                '11:00 - 12:00' => ['subject' => 'Social Studies', 'teacher' => 'Sultana Begum', 'room' => 'Room 103'],
                '12:00 - 01:00' => ['subject' => 'Break', 'teacher' => '-', 'room' => '-'],
            ],
            'Sunday' => [
                '08:00 - 09:00' => ['subject' => 'Computer Science', 'teacher' => 'Mohammad Ali Khan', 'room' => 'Computer Lab'],
                '09:00 - 10:00' => ['subject' => 'Mathematics', 'teacher' => 'Md. Kamal Hossain', 'room' => 'Room 101'],
                '10:00 - 11:00' => ['subject' => 'English', 'teacher' => 'Farida Yasmin', 'room' => 'Room 102'],
                '11:00 - 12:00' => ['subject' => 'Science', 'teacher' => 'Dr. Abdur Rahman', 'room' => 'Lab 1'],
                '12:00 - 01:00' => ['subject' => 'Break', 'teacher' => '-', 'room' => '-'],
            ],
            'Monday' => [
                '08:00 - 09:00' => ['subject' => 'Social Studies', 'teacher' => 'Sultana Begum', 'room' => 'Room 103'],
                '09:00 - 10:00' => ['subject' => 'Computer Science', 'teacher' => 'Mohammad Ali Khan', 'room' => 'Computer Lab'],
                '10:00 - 11:00' => ['subject' => 'Mathematics', 'teacher' => 'Md. Kamal Hossain', 'room' => 'Room 101'],
                '11:00 - 12:00' => ['subject' => 'English', 'teacher' => 'Farida Yasmin', 'room' => 'Room 102'],
                '12:00 - 01:00' => ['subject' => 'Break', 'teacher' => '-', 'room' => '-'],
            ],
            'Tuesday' => [
                '08:00 - 09:00' => ['subject' => 'Science', 'teacher' => 'Dr. Abdur Rahman', 'room' => 'Lab 1'],
                '09:00 - 10:00' => ['subject' => 'Social Studies', 'teacher' => 'Sultana Begum', 'room' => 'Room 103'],
                '10:00 - 11:00' => ['subject' => 'Computer Science', 'teacher' => 'Mohammad Ali Khan', 'room' => 'Computer Lab'],
                '11:00 - 12:00' => ['subject' => 'Mathematics', 'teacher' => 'Md. Kamal Hossain', 'room' => 'Room 101'],
                '12:00 - 01:00' => ['subject' => 'Break', 'teacher' => '-', 'room' => '-'],
            ],
            'Wednesday' => [
                '08:00 - 09:00' => ['subject' => 'English', 'teacher' => 'Farida Yasmin', 'room' => 'Room 102'],
                '09:00 - 10:00' => ['subject' => 'Science', 'teacher' => 'Dr. Abdur Rahman', 'room' => 'Lab 1'],
                '10:00 - 11:00' => ['subject' => 'Social Studies', 'teacher' => 'Sultana Begum', 'room' => 'Room 103'],
                '11:00 - 12:00' => ['subject' => 'Computer Science', 'teacher' => 'Mohammad Ali Khan', 'room' => 'Computer Lab'],
                '12:00 - 01:00' => ['subject' => 'Break', 'teacher' => '-', 'room' => '-'],
            ],
        ];

        return view('student.routine', compact('timetable', 'timeSlots', 'days'));
    }

    // public function marks()
    // {
    //     $marks = [
    //         ['subject' => 'Mathematics', 'exam' => 'Mid Term', 'marks' => 85, 'total' => 100, 'grade' => 'A', 'date' => '2024-09-15'],
    //         ['subject' => 'English', 'exam' => 'Mid Term', 'marks' => 92, 'total' => 100, 'grade' => 'A+', 'date' => '2024-09-16'],
    //         ['subject' => 'Science', 'exam' => 'Mid Term', 'marks' => 78, 'total' => 100, 'grade' => 'B+', 'date' => '2024-09-17'],
    //         ['subject' => 'Social Studies', 'exam' => 'Mid Term', 'marks' => 88, 'total' => 100, 'grade' => 'A', 'date' => '2024-09-18'],
    //         ['subject' => 'Computer Science', 'exam' => 'Mid Term', 'marks' => 95, 'total' => 100, 'grade' => 'A+', 'date' => '2024-09-19'],
    //     ];

    //     return view('student.marks', compact('marks'));
    // }

    // public function attendance()
    // {
    //     $attendance = [
    //         ['date' => '2024-10-01', 'day' => 'Tuesday', 'status' => 'Present', 'time' => '08:15 AM'],
    //         ['date' => '2024-10-02', 'day' => 'Wednesday', 'status' => 'Present', 'time' => '08:10 AM'],
    //         ['date' => '2024-10-03', 'day' => 'Thursday', 'status' => 'Late', 'time' => '08:45 AM'],
    //         ['date' => '2024-10-04', 'day' => 'Friday', 'status' => 'Present', 'time' => '08:12 AM'],
    //         ['date' => '2024-10-05', 'day' => 'Saturday', 'status' => 'Present', 'time' => '08:08 AM'],
    //         ['date' => '2024-10-06', 'day' => 'Sunday', 'status' => 'Present', 'time' => '08:20 AM'],
    //     ];

    //     return view('student.attendance', compact('attendance'));
    // }
}