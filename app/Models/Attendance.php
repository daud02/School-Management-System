<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'class',
        'date',
        'status',
    ];
    // Make sure date is automatically cast to a Carbon instance
    protected $casts = [
        'date' => 'date',   
    ];

    // Relationship with Student model
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
