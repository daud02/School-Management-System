<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Routine;
use App\Models\Student;

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
        ->where('student', $studentId)
        ->count();

    $presentCount = DB::table('attendances')
        ->where('student', $studentId)
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
    ->where('student_id', $studentId) // filter by student
    ->select('subject', 'marks as marks', 'created_at as date') // select columns directly
    ->get();


    // Calculate overall average
    $overallAvg = $marks->avg(fn($m) => $m->marks);
    $days = ['Saturday','Sunday','Monday','Tuesday','Wednesday'];




    $timeSlots = [
        '08:00 AM - 09:00 AM',
        '09:00 AM - 10:00 AM',
        '10:00 AM - 11:00 AM',
        '11:00 AM - 12:00 PM'
    ];
    $today = Carbon::now()->format('l'); // e.g., Monday
    $student = Student::where('student_id', $studentId)->firstOrFail();
    $class = $student->class;
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
        
            $todaySchedule = $todaySchedule->map(function ($s) use ($timeSlots) {
                return (object)[
                    'time' => $timeSlots[$s->row] ?? 'Slot ' . ($s->row + 1),
                    'subject' => $s->subject,
                    'room' => $s->room,
                    'teacher' => $s->instructor
                ];
            });
    }
    return view('student.dashboard', compact('stats', 'marks', 'overallAvg','todaySchedule','student'));
    }
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
    public function destroy($student_id)
    {
        // Find student by student_id field
        $student = Student::where('student_id', $student_id)->firstOrFail();
        
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
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