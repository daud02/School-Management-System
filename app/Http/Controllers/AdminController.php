<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_students' => 120,
            'total_classes' => 6,
            'total_subjects' => 8,
            'total_teachers' => 12
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function students()
    {
        $students = [
            ['id' => 'STU001', 'name' => 'Md. Rafiul Islam', 'email' => 'rafiul.islam@student.com', 'class' => 'Class 6A', 'gender' => 'Male', 'date_of_birth' => '2010-05-15', 'phone' => '01712345678', 'address' => 'Dhaka, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU002', 'name' => 'Fatema Akter', 'email' => 'fatema.akter@student.com', 'class' => 'Class 6A', 'gender' => 'Female', 'date_of_birth' => '2010-07-22', 'phone' => '01823456789', 'address' => 'Chittagong, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU003', 'name' => 'Md. Sakib Rahman', 'email' => 'sakib.rahman@student.com', 'class' => 'Class 6B', 'gender' => 'Male', 'date_of_birth' => '2010-03-10', 'phone' => '01934567890', 'address' => 'Sylhet, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU004', 'name' => 'Tasnia Haque', 'email' => 'tasnia.haque@student.com', 'class' => 'Class 6B', 'gender' => 'Female', 'date_of_birth' => '2010-09-18', 'phone' => '01645678901', 'address' => 'Rajshahi, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU005', 'name' => 'Md. Tanvir Hossain', 'email' => 'tanvir.hossain@student.com', 'class' => 'Class 7A', 'gender' => 'Male', 'date_of_birth' => '2009-06-25', 'phone' => '01756789012', 'address' => 'Khulna, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU006', 'name' => 'Nusrat Jahan', 'email' => 'nusrat.jahan@student.com', 'class' => 'Class 7A', 'gender' => 'Female', 'date_of_birth' => '2009-11-30', 'phone' => '01867890123', 'address' => 'Barisal, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU007', 'name' => 'Md. Ashraful Alam', 'email' => 'ashraful.alam@student.com', 'class' => 'Class 7B', 'gender' => 'Male', 'date_of_birth' => '2009-02-14', 'phone' => '01978901234', 'address' => 'Rangpur, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU008', 'name' => 'Farjana Sultana', 'email' => 'farjana.sultana@student.com', 'class' => 'Class 7B', 'gender' => 'Female', 'date_of_birth' => '2009-08-05', 'phone' => '01689012345', 'address' => 'Mymensingh, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU009', 'name' => 'Md. Kamal Uddin', 'email' => 'kamal.uddin@student.com', 'class' => 'Class 8A', 'gender' => 'Male', 'date_of_birth' => '2008-04-20', 'phone' => '01790123456', 'address' => 'Cumilla, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU010', 'name' => 'Sabrina Yasmin', 'email' => 'sabrina.yasmin@student.com', 'class' => 'Class 8A', 'gender' => 'Female', 'date_of_birth' => '2008-12-08', 'phone' => '01801234567', 'address' => 'Gazipur, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU011', 'name' => 'Md. Rashed Khan', 'email' => 'rashed.khan@student.com', 'class' => 'Class 8B', 'gender' => 'Male', 'date_of_birth' => '2008-01-17', 'phone' => '01912345678', 'address' => 'Narayanganj, Bangladesh', 'status' => 'Active'],
            ['id' => 'STU012', 'name' => 'Lamia Ahmed', 'email' => 'lamia.ahmed@student.com', 'class' => 'Class 8B', 'gender' => 'Female', 'date_of_birth' => '2008-10-03', 'phone' => '01623456789', 'address' => 'Jessore, Bangladesh', 'status' => 'Active'],
        ];

        return view('admin.students', compact('students'));
    }

    public function classes()
    {
        $classes = [
            [
                'id' => 1, 
                'name' => 'Class 6A', 
                'section' => 'A',
                'students' => 20, 
                'teacher' => 'Md. Kamal Hossain'
            ],
            [
                'id' => 2, 
                'name' => 'Class 6B', 
                'section' => 'B',
                'students' => 20, 
                'teacher' => 'Farida Yasmin'
            ],
            [
                'id' => 3, 
                'name' => 'Class 7A', 
                'section' => 'A',
                'students' => 20, 
                'teacher' => 'Dr. Abdur Rahman'
            ],
            [
                'id' => 4, 
                'name' => 'Class 7B', 
                'section' => 'B',
                'students' => 20, 
                'teacher' => 'Sultana Begum'
            ],
            [
                'id' => 5, 
                'name' => 'Class 8A', 
                'section' => 'A',
                'students' => 20, 
                'teacher' => 'Mohammad Ali Khan'
            ],
            [
                'id' => 6, 
                'name' => 'Class 8B', 
                'section' => 'B',
                'students' => 20, 
                'teacher' => 'Nazma Khatun'
            ],
        ];

        return view('admin.classes', compact('classes'));
    }

    public function marks()
    {
        $marks = [
            ['student_name' => 'Md. Rafiul Islam', 'class' => 'Class 6A', 'subject' => 'Mathematics', 'marks' => 85, 'grade' => 'A', 'exam_type' => 'Mid Term', 'date' => '2024-10-01'],
            ['student_name' => 'Fatema Akter', 'class' => 'Class 6A', 'subject' => 'English', 'marks' => 92, 'grade' => 'A+', 'exam_type' => 'Mid Term', 'date' => '2024-10-01'],
            ['student_name' => 'Md. Sakib Rahman', 'class' => 'Class 6B', 'subject' => 'Science', 'marks' => 78, 'grade' => 'B+', 'exam_type' => 'Mid Term', 'date' => '2024-10-01'],
            ['student_name' => 'Tasnia Haque', 'class' => 'Class 6B', 'subject' => 'Mathematics', 'marks' => 88, 'grade' => 'A', 'exam_type' => 'Mid Term', 'date' => '2024-10-01'],
            ['student_name' => 'Md. Tanvir Hossain', 'class' => 'Class 7A', 'subject' => 'Computer Science', 'marks' => 95, 'grade' => 'A+', 'exam_type' => 'Mid Term', 'date' => '2024-10-02'],
            ['student_name' => 'Nusrat Jahan', 'class' => 'Class 7A', 'subject' => 'Social Studies', 'marks' => 82, 'grade' => 'A', 'exam_type' => 'Mid Term', 'date' => '2024-10-02'],
            ['student_name' => 'Md. Ashraful Alam', 'class' => 'Class 7B', 'subject' => 'Mathematics', 'marks' => 70, 'grade' => 'B', 'exam_type' => 'Mid Term', 'date' => '2024-10-02'],
            ['student_name' => 'Farjana Sultana', 'class' => 'Class 7B', 'subject' => 'English', 'marks' => 87, 'grade' => 'A', 'exam_type' => 'Mid Term', 'date' => '2024-10-02'],
            ['student_name' => 'Md. Kamal Uddin', 'class' => 'Class 8A', 'subject' => 'Science', 'marks' => 91, 'grade' => 'A+', 'exam_type' => 'Mid Term', 'date' => '2024-10-03'],
            ['student_name' => 'Sabrina Yasmin', 'class' => 'Class 8A', 'subject' => 'Mathematics', 'marks' => 76, 'grade' => 'B+', 'exam_type' => 'Mid Term', 'date' => '2024-10-03'],
            ['student_name' => 'Md. Rashed Khan', 'class' => 'Class 8B', 'subject' => 'Computer Science', 'marks' => 89, 'grade' => 'A', 'exam_type' => 'Mid Term', 'date' => '2024-10-03'],
            ['student_name' => 'Lamia Ahmed', 'class' => 'Class 8B', 'subject' => 'Social Studies', 'marks' => 93, 'grade' => 'A+', 'exam_type' => 'Mid Term', 'date' => '2024-10-03'],
        ];

        return view('admin.marks', compact('marks'));
    }

    public function attendance()
    {
        $attendance = [
            ['student' => 'Md. Rafiul Islam', 'class' => 'Class 6A', 'date' => '2024-10-01', 'status' => 'Present'],
            ['student' => 'Fatema Akter', 'class' => 'Class 6A', 'date' => '2024-10-01', 'status' => 'Present'],
            ['student' => 'Md. Sakib Rahman', 'class' => 'Class 6B', 'date' => '2024-10-01', 'status' => 'Late'],
            ['student' => 'Tasnia Haque', 'class' => 'Class 6B', 'date' => '2024-10-01', 'status' => 'Present'],
            ['student' => 'Md. Tanvir Hossain', 'class' => 'Class 7A', 'date' => '2024-10-02', 'status' => 'Present'],
            ['student' => 'Nusrat Jahan', 'class' => 'Class 7A', 'date' => '2024-10-02', 'status' => 'Absent'],
            ['student' => 'Md. Ashraful Alam', 'class' => 'Class 7B', 'date' => '2024-10-02', 'status' => 'Present'],
            ['student' => 'Farjana Sultana', 'class' => 'Class 7B', 'date' => '2024-10-02', 'status' => 'Present'],
            ['student' => 'Md. Kamal Uddin', 'class' => 'Class 8A', 'date' => '2024-10-03', 'status' => 'Present'],
            ['student' => 'Sabrina Yasmin', 'class' => 'Class 8A', 'date' => '2024-10-03', 'status' => 'Present'],
            ['student' => 'Md. Rashed Khan', 'class' => 'Class 8B', 'date' => '2024-10-03', 'status' => 'Late'],
            ['student' => 'Lamia Ahmed', 'class' => 'Class 8B', 'date' => '2024-10-03', 'status' => 'Present'],
        ];

        return view('admin.attendance', compact('attendance'));
    }
}