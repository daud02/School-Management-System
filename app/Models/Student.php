<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        
        'name',
        'email',
        'class',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        
        
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Boot the model.
     */
//     protected static function boot()
//     {
//         parent::boot();

//         static::creating(function ($student) {
//             if (empty($student->student_id)) {
//                 $student->student_id = 'STU' . str_pad(Student::max('id') + 1, 3, '0', STR_PAD_LEFT);
//             }
//         });
//     }
 }