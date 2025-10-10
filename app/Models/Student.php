<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id', 'full_name', 'email', 'class', 
        'gender', 'date_of_birth', 'phone',
    ];

    // Example: relation to attendance (once we create attendances table)
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
