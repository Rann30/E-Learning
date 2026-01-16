<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolationCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'card_number',
        'is_active',
        'description'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
