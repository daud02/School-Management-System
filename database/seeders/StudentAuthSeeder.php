<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentAuth;
use Illuminate\Support\Facades\Hash;

class StudentAuthSeeder extends Seeder
{
    public function run(): void
    {
        $classes = ['6A', '6B', '6C', '7A', '7B', '7C', '8A', '8B', '8C', '9A', '9B', '9C'];

        $maleNames = [
            'Arif Rahman', 'Tuhin Hasan', 'Rafiul Alam', 'Imran Hossain', 'Rahat Karim',
            'Farhan Alam', 'Nazmul Hasan', 'Nabil Chowdhury', 'Mehedi Islam', 'Rakibul Islam'
        ];

        $femaleNames = [
            'Mitu Akter', 'Shorna Khatun', 'Lamia Sultana', 'Afsana Nahar', 'Sadia Rahman',
            'Samiha Yasmin', 'Riyana Sultana', 'Zarin Jahan', 'Ayesha Noor', 'Tania Khatun'
        ];

        $studentId = 1;

        foreach ($classes as $class) {
            for ($i = 0; $i < 10; $i++) {
                $isMale = ($i % 2 == 0);
                $name = $isMale ? $maleNames[$i] : $femaleNames[$i];

                // must match student seeder email
                $email = strtolower(str_replace(' ', '', $name)) . strtolower($class) . '@example.com';

                StudentAuth::updateOrInsert(
                    ['student_id' => $studentId],
                    [
                        'email' => $email,
                        'password' => Hash::make("daud"),
                    ]
                );

                $studentId++;
            }
        }
    }
}
