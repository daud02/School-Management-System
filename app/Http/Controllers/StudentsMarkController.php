<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mark;

class StudentsMarkController extends Controller
{
    /**
     * Display marks for the logged-in student
     */
    public function index()
    {
        $student_id = session('student.id'); // or session('student.student_id')

        // Fetch marks directly from marks table
        $marks = Mark::where('student_id', $student_id)
                     ->get()
                     ->map(function($mark) {
                         return [
                             'subject' => $mark->subject,         // subject name directly
                             'exam'    => $mark->exam_type ?? '', // exam type column, optional
                             'marks'   => $mark->marks,           // marks scored
                             'total'   => 100,                    // assuming total marks is 100
                             'grade'   => $this->calculateGrade($mark->marks),
                         ];
                     });

        return view('student.marks', compact('marks'));
    }

    /**
     * Calculate grade based on marks
     */
    private function calculateGrade($marks)
    {
        if ($marks >= 80) return 'A+';
        if ($marks >= 70) return 'A';
        if ($marks >= 60) return 'A-';
        if ($marks >= 50) return 'B';
        if ($marks >= 40) return 'C';
        if ($marks >= 33) return 'D';
        return 'F';
    }
}
