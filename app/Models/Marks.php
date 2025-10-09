<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'class',
        'subject',
        'marks',
        'grade',
        'exam_type',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
        'marks' => 'integer'
    ];
}