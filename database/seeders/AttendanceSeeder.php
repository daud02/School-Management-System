<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $studentId = 1; // student_id to seed
        $class = 'Mathematics'; // example class

        $dates = [
            '2025-10-01',
            '2025-10-02',
            '2025-10-03',
            '2025-10-04',
            '2025-10-05',
        ];

        foreach ($dates as $date) {
            DB::table('attendances')->updateOrInsert(
                ['student' => $studentId, 'class' => $class, 'date' => Carbon::parse($date)],
                ['status' => rand(0, 1) ? 'present' : 'absent', 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
