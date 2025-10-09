<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the marks.
     */
    public function index()
    {
        $marks = Marks::all();
        return view('admin.marks', compact('marks'));
    }

    /**
     * Show the form for creating a new mark entry.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created mark in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'subject' => 'required|string|max:100',
            'marks' => 'required|integer|min:0|max:100',
            'grade' => 'required|string|max:10',
            'exam_type' => 'required|string|max:100',
            'date' => 'required|date'
        ]);

        Marks::create($validated);

        return redirect()->route('marks.index')->with('success', 'Mark added successfully!');
    }

    /**
     * Show the form for editing the specified mark.
     */
    public function edit(Marks $marks)
    {
        return view('admin.edit', compact('marks'));
    }

    /**
     * Update the specified mark in database.
     */
    public function update(Request $request,Marks $marks )
    {
       

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'subject' => 'required|string|max:100',
            'marks' => 'required|integer|min:0|max:100',
            'grade' => 'required|string|max:10',
            'exam_type' => 'required|string|max:100',
            'date' => 'required|date'
        ]);

       $marks->update($validated);

        return redirect()->route('marks.index')->with('success', 'Mark updated successfully!');
    }

    /**
     * Remove the specified mark from database.
     */
    public function destroy(Marks $marks)
    {
        $marks->delete();

        return redirect()->route('marks.index')->with('success', 'Mark deleted successfully!');
    }
}