<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
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

        $addresses = [
            'Mirpur, Dhaka', 'Dhanmondi, Dhaka', 'Uttara, Dhaka', 'Rajshahi', 'Sylhet',
            'Khulna', 'Gazipur', 'Barishal', 'Comilla', 'Narayanganj'
        ];

        $studentId = 1;

        foreach ($classes as $cIndex => $class) {
            for ($i = 0; $i < 10; $i++) {
                // Alternate gender deterministically
                $isMale = ($i % 2 == 0);
                $name = $isMale ? $maleNames[$i] : $femaleNames[$i];
                $gender = $isMale ? 'Male' : 'Female';

                // Deterministic date of birth: year + month + day based on class and index
                $year = 2011 - $cIndex; // older classes = older students
                $month = ($i % 12) + 1;
                $day = ($i + 5) <= 28 ? ($i + 5) : ($i - 3);

                $dob = sprintf('%04d-%02d-%02d', $year, $month, $day);

                // Calculative email and phone
                $email = strtolower(str_replace(' ', '', $name)) . strtolower($class) . '@example.com';
                $phone = '0171' . str_pad(($cIndex * 10) + $i, 7, '0', STR_PAD_LEFT);
                $address = $addresses[$i];

                Student::updateOrInsert(
                    ['student_id' => $studentId],
                    [
                        'name' => $name,
                        'email' => $email,
                        'class' => $class,
                        'gender' => $gender,
                        'date_of_birth' => $dob,
                        'phone' => $phone,
                        'address' => $address,
                    ]
                );

                $studentId++;
            }
        }
    }
}
