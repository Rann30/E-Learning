<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'teacher_id', 'course_id', 'subject_id', 'title', 'description', 'token', 'start_at', 'end_at', 'is_published'
    ];

    protected $dates = ['start_at', 'end_at'];

    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }
}
