<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentAuth extends Authenticatable
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'student_auth';   // matches your migration table name

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden when serialized.
     */
    protected $hidden = [
        'password',
        'remember_token', // optional if you use remember me
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Automatically hash password when setting it
     */
    public function setPasswordAttribute($value)
    {
        // Only hash if it’s not already hashed
        if (!empty($value) && substr($value, 0, 7) !== '$2y$10$') {
            $this->attributes['password'] = bcrypt($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }
}