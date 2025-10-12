<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mark;


class MarkController extends Controller
{
    /**
     * Display a listing of marks
     */
    public function index()
    {
        // Fetch all marks with student relation and convert to array format expected by the blade
        $marks = Mark::with('student')->get()->map(function ($mark) {
            return [
                'id' => $mark->id,
                'student_id' => $mark->student_id,
                'student_name' => $mark->student ? $mark->student->name : null,
                'class' => $mark->class,
                'subject' => $mark->subject,
                'marks' => $mark->marks,
                'grade' => $mark->grade,
                'exam_type' => $mark->exam_type,
                // Ensure date is formatted as Y-m-d for HTML input[type=date]
                'date' => $mark->date ? ($mark->date instanceof \Illuminate\Support\Carbon ? $mark->date->format('Y-m-d') : date('Y-m-d', strtotime($mark->date))) : null,
            ];
        })->toArray();

        return view('admin.marks', compact('marks'));
    }

    /**
     * Store a newly created mark
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:255',
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
     * Update the specified mark
     */
    public function update(Request $request, $id)
    {
        // Find mark by id
        $mark = Marks::where('id', $id)->firstOrFail();

        $validated = $request->validate([
            'student_id' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'subject' => 'required|string|max:100',
            'marks' => 'required|integer|min:0|max:100',
            'grade' => 'required|string|max:10',
            'exam_type' => 'required|string|max:100',
            'date' => 'required|date'
        ]);

        $mark->update($validated);

        return redirect()->route('marks.index')->with('success', 'Mark updated successfully!');
    }

    /**
     * Remove the specified mark
     */
    public function destroy($id)
    {
        // Find mark by id
        $mark = Marks::where('id', $id)->firstOrFail();
        
        $mark->delete();

        return redirect()->route('marks.index')->with('success', 'Mark deleted successfully!');
    }
}