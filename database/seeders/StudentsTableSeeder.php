<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    public function run(): void
    {
        Student::firstOrCreate(
            ['student_id' => '1'], // unique check
            [
                'full_name' => 'John Doe',
                'email' => 'john@example.com',
                'class' => '10',
                'gender' => 'Male',
                'date_of_birth' => '2008-05-12',
                'phone' => '0123456789',
            ]
        );

        Student::firstOrCreate(
            ['student_id' => '2'], // unique check
            [
                'full_name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'class' => '10',
                'gender' => 'Female',
                'date_of_birth' => '2008-08-22',
                'phone' => '0987654321',
            ]
        );
    }
}
