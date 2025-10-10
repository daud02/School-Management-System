<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        Subject::firstOrCreate(
            ['code' => 'MATH'],
            ['name' => 'Mathematics', 'class' => '10']
        );

        Subject::firstOrCreate(
            ['code' => 'PHY'],
            ['name' => 'Physics', 'class' => '10']
        );

        Subject::firstOrCreate(
            ['code' => 'CHEM'],
            ['name' => 'Chemistry', 'class' => '10']
        );
    }
}
