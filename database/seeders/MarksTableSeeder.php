<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mark;
use Carbon\Carbon;

class MarksTableSeeder extends Seeder
{
    public function run(): void
    {
        // Sample data for student 1
        Mark::firstOrCreate(
            ['student_id' => '1', 'subject' => 'Mathematics', 'exam_type' => 'Midterm'],
            [
                'class' => '10',
                'marks' => 85,
                'grade' => 'A+',
                'date' => Carbon::parse('2025-09-01'),
            ]
        );

        Mark::firstOrCreate(
            ['student_id' => '1', 'subject' => 'Physics', 'exam_type' => 'Midterm'],
            [
                'class' => '10',
                'marks' => 78,
                'grade' => 'A',
                'date' => Carbon::parse('2025-09-02'),
            ]
        );

        // Sample data for student 2
        Mark::firstOrCreate(
            ['student_id' => '2', 'subject' => 'Mathematics', 'exam_type' => 'Midterm'],
            [
                'class' => '10',
                'marks' => 92,
                'grade' => 'A+',
                'date' => Carbon::parse('2025-09-01'),
            ]
        );

        Mark::firstOrCreate(
            ['student_id' => '2', 'subject' => 'Physics', 'exam_type' => 'Midterm'],
            [
                'class' => '10',
                'marks' => 68,
                'grade' => 'A-',
                'date' => Carbon::parse('2025-09-02'),
            ]
        );
    }
}
