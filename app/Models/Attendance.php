<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student',
        'class',
        'status',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}