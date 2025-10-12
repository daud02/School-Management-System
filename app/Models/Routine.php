<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'row',
        'col',
        'subject',
        'instructor',
        'room',
    ];
}
