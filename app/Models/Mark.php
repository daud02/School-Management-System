<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Laravel will automatically use 'marks', 
     * so this line is optional unless your table name is different.
     */
    protected $table = 'marks';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_id',
        'student_name',
        'class',
        'subject',
        'marks',
        'grade',
        'exam_type',
        'date',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'marks' => 'integer',
        'date' => 'date',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
