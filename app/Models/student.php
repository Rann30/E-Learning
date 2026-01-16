<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nis',
        'class',
        'status',
        'photo',
        'points',
        'badges'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Relasi ke Violation Card
    public function violationCards()
    {
        return $this->hasMany(ViolationCard::class);
    }
}
