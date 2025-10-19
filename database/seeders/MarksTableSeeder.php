<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mark;
use Carbon\Carbon;

class MarksTableSeeder extends Seeder
{
    public function run(): void
    {
        $classes = ['6A', '6B', '6C'];
        $maleNames = [
            'Arif Rahman', 'Tuhin Hasan', 'Rafiul Alam', 'Imran Hossain', 'Rahat Karim',
            'Farhan Alam', 'Nazmul Hasan', 'Nabil Chowdhury', 'Mehedi Islam', 'Rakibul Islam'
        ];
        $femaleNames = [
            'Mitu Akter', 'Shorna Khatun', 'Lamia Sultana', 'Afsana Nahar', 'Sadia Rahman',
            'Samiha Yasmin', 'Riyana Sultana', 'Zarin Jahan', 'Ayesha Noor', 'Tania Khatun'
        ];

        $subjects = ['Bangla', 'English', 'Mathematics'];
        $examType = 'Midterm';
        $baseDate = Carbon::parse('2025-09-01');
        $studentId = 1;

        foreach ($classes as $classIndex => $class) {
            for ($i = 0; $i < 10; $i++) {
                $isMale = $i % 2 === 0;
                $name = $isMale ? $maleNames[$i] : $femaleNames[$i];

                foreach ($subjects as $sIndex => $subject) {
                    // Calculated marks and grade (deterministic)
                    $marks = 60 + (($classIndex * 3 + $i + $sIndex) % 25); // 60–84 range
                    $grade = $this->gradeFromMarks($marks);
                    $date = $baseDate->copy()->addDays($sIndex);

                    Mark::updateOrInsert(
                        ['student_id' => $studentId, 'subject' => $subject, 'exam_type' => $examType],
                        [
                            'student_name' => $name,
                            'class' => $class,
                            'marks' => $marks,
                            'grade' => $grade,
                            'date' => $date,
                        ]
                    );
                }

                $studentId++;
            }
        }
    }

    private function gradeFromMarks($marks)
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
