<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $class = '6A';
        $startDate = Carbon::now()->subDays(9)->startOfDay(); // previous 10 days including today

        // Deterministic attendance pattern: alternates presence by student/day index
        for ($studentId = 1; $studentId <= 10; $studentId++) {
            for ($day = 0; $day < 10; $day++) {
                $date = $startDate->copy()->addDays($day);

                // Calculative presence pattern (no randomness)
                $status = (($studentId + $day) % 3 == 0) ? 'absent' : 'present';

                DB::table('attendances')->updateOrInsert(
                    [
                        'student' => $studentId,
                        'class' => $class,
                        'date' => $date,
                    ],
                    [
                        'status' => $status,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
