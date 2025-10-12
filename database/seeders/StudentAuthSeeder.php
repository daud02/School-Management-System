<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentAuth;
use Illuminate\Support\Facades\Hash;

class StudentAuthSeeder extends Seeder
{
    public function run(): void
    {
        StudentAuth::firstOrCreate(
            // 🔑 Fields to check for existing record
            ['student_id' => '1'],
            // 🆕 Data to insert if not exists
            [
                'email'    => 'john@example.com',
                'password' => Hash::make("daud"), // hashed password
            ]
        );
    }
}
