<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mark;
use App\Models\Subject;

class StudentMarkController extends Controller
{
    public function index()
    {
        $student_id = session('student.id'); 
        // Fetch marks and join with subjects table to get subject name
        $marks = Mark::where('student_id', $student_id)
                     ->join('subjects', 'marks.subject_code', '=', 'subjects.code')
                     ->select('marks.*', 'subjects.name as subject_name')
                     ->get()
                     ->map(function($mark) {
                         return [
                             'subject' => $mark->subject_name, // use subject name now
                             'exam' => $mark->exam,
                             'marks' => $mark->mark,
                             'total' => 100,
                             'grade' => $this->calculateGrade($mark->mark),
                         ];
                     });
        return view('student.marks', compact('marks'));
    }
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
