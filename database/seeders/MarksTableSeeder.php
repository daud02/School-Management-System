<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mark;

class MarksTableSeeder extends Seeder
{
    public function run(): void
    {
        Mark::firstOrCreate(
            ['student_id' => '1', 'subject_code' => 'MATH', 'exam' => 'Final'],
            ['mark' => 85]
        );

        Mark::firstOrCreate(
            ['student_id' => '1', 'subject_code' => 'PHY', 'exam' => 'Final'],
            ['mark' => 72]
        );

        Mark::firstOrCreate(
            ['student_id' => '2', 'subject_code' => 'MATH', 'exam' => 'Final'],
            ['mark' => 65]
        );
    }
}
