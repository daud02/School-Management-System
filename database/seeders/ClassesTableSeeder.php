<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['name' => '6', 'section' => 'A', 'teacher' => 'Md. Hasan Ali'],
            ['name' => '6', 'section' => 'B', 'teacher' => 'Shamsunnahar Begum'],
            ['name' => '6', 'section' => 'C', 'teacher' => 'Kamal Hossain'],
            ['name' => '7', 'section' => 'A', 'teacher' => 'Farzana Akter'],
            ['name' => '7', 'section' => 'B', 'teacher' => 'Rashedul Karim'],
            ['name' => '7', 'section' => 'C', 'teacher' => 'Momena Khatun'],
            ['name' => '8', 'section' => 'A', 'teacher' => 'Sharif Ahmed'],
            ['name' => '8', 'section' => 'B', 'teacher' => 'Fatema Jahan'],
            ['name' => '8', 'section' => 'C', 'teacher' => 'Nurul Islam'],
            ['name' => '9', 'section' => 'A', 'teacher' => 'Anwara Sultana'],
            ['name' => '9', 'section' => 'B', 'teacher' => 'Sohail Ahmed'],
            ['name' => '9', 'section' => 'C', 'teacher' => 'Lutfor Rahman'],
        ];

        foreach ($classes as $index => $class) {
            DB::table('classes')->updateOrInsert(
                ['id' => $index + 1],
                [
                    'name' => $class['name'],
                    'section' => $class['section'],
                    'students' => 10, // consistent with your StudentsTableSeeder
                    'teacher' => $class['teacher'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
