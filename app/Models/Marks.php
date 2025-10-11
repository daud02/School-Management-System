<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Marks extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
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

    /**
     * Student relationship (by student_id)
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}