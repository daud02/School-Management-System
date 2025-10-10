<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminAuth;
use Illuminate\Support\Facades\Hash;

class AdminAuthSeeder extends Seeder
{
    public function run(): void
    {
        AdminAuth::firstOrCreate(
            ['email' => 'admin@example.com'], // check by email
            [
                'password' => Hash::make('password123'), // hashed password
            ]
        );
    }
}
