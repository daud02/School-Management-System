<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Routine;

class RoutineSeeder extends Seeder
{
    public function run(): void
    {
        $class = '10';

        // Example subjects, instructors, and rooms for demonstration
        $subjects = [
            ['Math', 'Physics', 'Chemistry', 'English', 'Programming'],
            ['Data Structures', 'Electronics', 'Digital Logic', 'Statistics', 'Algorithms'],
            ['Discrete Math', 'Operating System', 'Database', 'Networking', 'Software Eng'],
            ['Break', 'Physics Lab', 'Chemistry Lab', 'Programming Lab', 'Project Work'],
        ];

        $instructors = [
            ['Dr. Rahman', 'Prof. Karim', 'Dr. Alam', 'Mr. Hossain', 'Mr. Hasan'],
            ['Dr. Kabir', 'Dr. Haque', 'Prof. Islam', 'Dr. Amin', 'Mr. Rafiq'],
            ['Prof. Sultana', 'Dr. Rahim', 'Dr. Munna', 'Mr. Rashed', 'Prof. Tanvir'],
            ['-', 'Dr. Karim', 'Dr. Alam', 'Mr. Hasan', 'Dr. Kabir'],
        ];

        $rooms = [
            ['201', '202', '203', '204', '205'],
            ['301', '302', '303', '304', '305'],
            ['401', '402', '403', '404', '405'],
            ['-', 'Lab 1', 'Lab 2', 'Lab 3', 'Lab 4'],
        ];

        for ($row = 0; $row < 4; $row++) {
            for ($col = 0; $col < 5; $col++) {
                Routine::updateOrInsert(
                    ['class' => $class, 'row' => $row, 'col' => $col],
                    [
                        'subject' => $subjects[$row][$col],
                        'instructor' => $instructors[$row][$col],
                        'room' => $rooms[$row][$col],
                    ]
                );
            }
        }
    }
}
