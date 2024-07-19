<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $fillable = [
        'subject_id',
        'classroom_id',
        'department_id',
        'min_mark',
        'max_mark',
        'type',
    ];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'quiz_id', 'id');
    }
}