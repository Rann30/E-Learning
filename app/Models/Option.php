<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    protected $fillable = ['label', 'option_text', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
