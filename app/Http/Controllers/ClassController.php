<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes; // Add this import

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new class.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created class in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'students' => 'required|integer|min:1',
            'teacher' => 'required|string|max:255'
        ]);

        Classes::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Class created successfully!');
    }

    /**
     * Show the form for editing the specified class.
     */
    public function edit(Classes $classes)
    {
        return view('classes.edit', compact('classes'));
    }

    /**
     * Update the specified class in storage.
     */
    public function update(Request $request, Classes $classes)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'students' => 'required|integer|min:1',
            'teacher' => 'required|string|max:255'
        ]);

        $classes->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy(Classes $classes)
    {
        $classes->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully!');
    }
}