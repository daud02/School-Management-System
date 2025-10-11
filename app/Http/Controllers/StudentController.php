<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index()
    {
        // Fetch all students and convert to array format expected by the blade
        $students = Student::all()->map(function ($student) {
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

        return view('admin.students', compact('students'));
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id|max:50',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|max:255',
            'class' => 'required|string|max:50',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date|before:today',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, $student_id)
    {
        // Find student by student_id field
        $student = Student::where('student_id', $student_id)->firstOrFail();

        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id . '|max:50',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id . '|max:255',
            'class' => 'required|string|max:50',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date|before:today',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student
     */
    public function destroy($student_id)
    {
        // Find student by student_id field
        $student = Student::where('student_id', $student_id)->firstOrFail();
        
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}