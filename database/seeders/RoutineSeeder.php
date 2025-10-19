<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Routine;

class RoutineSeeder extends Seeder
{
    public function run(): void
    {
        $classes = ['6A', '6B', '6C'];

        // Routine grid (4 rows × 5 columns) for each class
        // Row = period blocks (e.g. Morning, Midday, Afternoon)
        // Col = weekdays (Monday–Friday)
        $subjects = [
            ['Bangla', 'English', 'Mathematics', 'General Science', 'ICT'],
            ['Religion', 'Bangladesh & Global Studies', 'Mathematics', 'English', 'Arts & Crafts'],
            ['Bangla', 'General Science', 'Mathematics', 'Physical Education', 'Music'],
            ['Break', 'Study Period', 'ICT Lab', 'Drawing', 'Assembly'],
        ];

        $instructors = [
            ['Mr. Rahman', 'Mrs. Karim', 'Mr. Alam', 'Mrs. Hossain', 'Mr. Hasan'],
            ['Mr. Kabir', 'Mrs. Jahan', 'Mr. Islam', 'Mr. Amin', 'Mrs. Rafiq'],
            ['Mrs. Sultana', 'Mr. Rahim', 'Mr. Munna', 'Mr. Rashed', 'Mrs. Tanvir'],
            ['-', 'Mr. Karim', 'Mr. Alam', 'Mrs. Hasan', 'Mrs. Kabir'],
        ];

        $rooms = [
            ['101', '102', '103', '104', '105'],
            ['106', '107', '108', '109', '110'],
            ['111', '112', '113', '114', '115'],
            ['-', 'Room-A', 'Lab-1', 'Art-Room', 'Auditorium'],
        ];

        foreach ($classes as $class) {
            for ($row = 0; $row < 4; $row++) {
                for ($col = 0; $col < 5; $col++) {
                    Routine::updateOrInsert(
                        [
                            'class' => $class,
                            'row' => $row,
                            'col' => $col,
                        ],
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
}
