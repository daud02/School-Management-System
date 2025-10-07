<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
          $students = Student::all();   // Fetch all students
    return view('students.index', compact('students'));

        // Filter by ID
        // if ($request->filled('id')) {
        //     $query->where('id', $request->id);
        // }

        // // Filter by Class
        // if ($request->filled('class')) {
        //     $query->where('class', $request->class);
        // }

        // // Filter by Student ID
        // if ($request->filled('student_id')) {
        //     $query->where('student_id', 'like', '%' . $request->student_id . '%');
        // }

        // $students = $query->paginate(10);
        // $classes = Student::distinct()->pluck('class');

       
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'class' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'class' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}