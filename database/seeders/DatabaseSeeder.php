<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::firstOrCreate(
            ['email' => 'test@example.com'], // check by email
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // set a default password
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );
        $this->call([
            StudentsTableSeeder::class,
            SubjectsTableSeeder::class,
            MarksTableSeeder::class,
            AttendanceSeeder::class,
            AdminAuthSeeder::class,
            RoutineSeeder::class,
        ]); 
    }
}
