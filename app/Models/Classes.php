<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Classes extends Model
{
     use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'section',
        'students',
        'teacher'
    ];

    protected $casts = [
        'students' => 'integer'
    ];
}
