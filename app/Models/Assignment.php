<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'course_id',
        'subject_id',
        'title',
        'description',
        'deadline',
        'max_score',
        'file',
        'is_published'
    ];

    protected $casts = [
        'deadline' => 'datetime'
    ];

    /* ================= RELATIONS ================= */

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }
}
