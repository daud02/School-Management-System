<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of classes
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

        return view('admin.classes', compact('classes'));
    }

    /**
     * Store a newly created class
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:10',
            'students' => 'required|integer|min:0',
            'teacher' => 'required|string|max:255'
        ]);

        Classes::create($validated);

        return redirect()->route('classes.index')->with('success', 'Class added successfully!');
    }

    /**
     * Update the specified class
     */
    public function update(Request $request, $id)
    {
        // Find class by id
        $class = Classes::where('id', $id)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:10',
            'students' => 'required|integer|min:0',
            'teacher' => 'required|string|max:255'
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified class
     */
    public function destroy($id)
    {
        // Find class by id
        $class = Classes::where('id', $id)->firstOrFail();
        
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}