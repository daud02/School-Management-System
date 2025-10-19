<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['code' => 'BAN6A',   'name' => 'Bangla',                     'class' => '6A'],
            ['code' => 'ENG6A',   'name' => 'English',                    'class' => '6A'],
            ['code' => 'MATH6A',  'name' => 'Mathematics',                'class' => '6A'],
            ['code' => 'SCI6B',   'name' => 'General Science',            'class' => '6B'],
            ['code' => 'REL6B',   'name' => 'Religion & Moral Education', 'class' => '6B'],
            ['code' => 'ICT6C',   'name' => 'Information & Communication Technology', 'class' => '6C'],
            ['code' => 'GEO7A',   'name' => 'Geography & Environment',    'class' => '7A'],
            ['code' => 'HIST7A',  'name' => 'Bangladesh & Global Studies','class' => '7A'],
            ['code' => 'AGR7B',   'name' => 'Agriculture Studies',        'class' => '7B'],
            ['code' => 'ART7C',   'name' => 'Arts & Crafts',              'class' => '7C'],
            ['code' => 'PHY8A',   'name' => 'Physics',                    'class' => '8A'],
            ['code' => 'CHEM8A',  'name' => 'Chemistry',                  'class' => '8A'],
            ['code' => 'BIO8B',   'name' => 'Biology',                    'class' => '8B'],
            ['code' => 'HOM8C',   'name' => 'Home Science',               'class' => '8C'],
            ['code' => 'ACC9A',   'name' => 'Accounting',                 'class' => '9A'],
            ['code' => 'ECO9A',   'name' => 'Economics',                  'class' => '9A'],
            ['code' => 'CIV9B',   'name' => 'Civics & Citizenship',       'class' => '9B'],
            ['code' => 'BUS9B',   'name' => 'Business Studies',           'class' => '9B'],
            ['code' => 'MUS9C',   'name' => 'Music',                      'class' => '9C'],
            ['code' => 'PHYED9C', 'name' => 'Physical Education',         'class' => '9C'],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrInsert(
                ['code' => $subject['code']],
                [
                    'name' => $subject['name'],
                    'class' => $subject['class'],
                ]
            );
        }
    }
}
