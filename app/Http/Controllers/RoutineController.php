<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use App\Models\Student; // your students table
use Carbon\Carbon;

class RoutineController extends Controller
{
    public function showStaticForm()
    {
        $days = ['Saturday','Sunday','Monday','Tuesday','Wednesday'];
        $timeSlots = [
            '08:00 AM - 09:00 AM',
            '09:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM'
        ];
        return view('admin.routine_static', compact('days', 'timeSlots'));
    }

    public function saveStaticForm(Request $request)
    {
        $days = ['Saturday','Sunday','Monday','Tuesday','Wednesday'];
        $timeSlots = [
            '08:00 AM - 09:00 AM',
            '09:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM'
        ];

        $validated = $request->validate([
            'class' => 'required|string|max:255',
            'day' => 'required|string',
            'time' => 'required|string',
            'subject' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:255',
        ]);

        $col = array_search($validated['day'], $days);
        $row = array_search($validated['time'], $timeSlots);

        if ($col === false || $row === false) {
            return back()->withErrors(['Invalid day or time selected']);
        }
        Routine::updateOrCreate(
            ['class' => $validated['class'], 'row' => $row, 'col' => $col],
            [
                'subject' => $validated['subject'],
                'instructor' => $validated['instructor'],
                'room' => $validated['room']
            ]
        );
        return back()->with('success', 'Routine cell saved successfully!');
    }
    // Show form to load/edit routine
    public function create(Request $request)
    {
        $class = $request->input('class'); // from GET param

        $days = ['Saturday','Sunday','Monday','Tuesday','Wednesday'];
        $timeSlots = [
            '08:00 AM - 09:00 AM',
            '09:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM'
        ];

        // Default empty grid
        $grid = [];
        for ($row = 0; $row < count($timeSlots); $row++) {
            for ($col = 0; $col < count($days); $col++) {
                $grid[$row][$col] = null;
            }
        }

        // If a class is selected, load existing routine
        if($class) {
            $routines = Routine::where('class', $class)->get();
            foreach($routines as $r) {
                $grid[$r->row][$r->col] = $r;
            }
        }

        return view('admin.routine_create', compact('class','days','timeSlots','grid'));
    }

    public function update(Request $request, $class)
    {
        $data = $request->input('routine', []);
    
        foreach ($data as $row => $cols) {
            foreach ($cols as $col => $cell) {
                Routine::updateOrCreate(
                    ['class' => $class, 'row' => $row, 'col' => $col],
                    [
                        'subject' => $cell['subject'] ?? null,
                        'instructor' => $cell['instructor'] ?? null,
                        'room' => $cell['room'] ?? null,
                    ]
                );
            }
        }
    
        return redirect()->back()->with('success', 'Routine updated successfully!');
    }
    
    public function show(Request $request)
    {
        // 1️⃣ Get student ID from session
        $studentId = $request->session()->get('student.student_id');

        // 2️⃣ Fetch student's class from students table
        $student = Student::where('student_id', $studentId)->first();
        if (!$student) {
            abort(404, 'Student not found');
        }
        $class = $student->class;

        // 3️⃣ Define 4x5 grid (time slots x days)
        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday'];
        $timeSlots = [
            '08:00 AM - 09:00 AM',
            '09:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM'
        ];

        // 4️⃣ Fetch routine for this class
        $routines = Routine::where('class', $class)->get();

        // 5️⃣ Build timetable array [day][time]
        $timetable = [];
        foreach ($routines as $r) {
            $day = $days[$r->col] ?? 'Unknown';    // col = day index
            $time = $timeSlots[$r->row] ?? 'Unknown'; // row = time index
            $timetable[$day][$time] = [
                'subject' => $r->subject,
                'teacher' => $r->instructor,
                'room' => $r->room,
            ];
        }

        return view('student.routine', compact('days', 'timeSlots', 'timetable'));
    }
    public function todaySchedule(Request $request)
    {
       // dd('todaySchedule called');
        $studentSession = $request->session()->get('student');

        if (!$studentSession) {
            return redirect()->route('student.login');
        }

        $studentId = $studentSession['student_id'];

        // Get student's class
        $student = Student::where('student_id', $studentId)->firstOrFail();
        $class = $student->class;

        // Days mapping (0 = Saturday, 1 = Sunday ... 4 = Wednesday)
        $days = ['Saturday','Sunday','Monday','Tuesday','Wednesday'];

        $today = Carbon::now()->format('l'); // e.g., Monday

        // If today is Friday or Saturday, return empty
        if (in_array($today, ['Friday','Saturday'])) {
            $todaySchedule = [];
        } else {
            // Find column index for today
            $col = array_search($today, $days);
            
            // Fetch routines for this class and today's column
            $todaySchedule = Routine::where('class', $class)
                ->where('col', $col)
                ->orderBy('row')
                ->get();
        }

        return view('student.dashboard', compact('todaySchedule', 'student'));
    }
}
