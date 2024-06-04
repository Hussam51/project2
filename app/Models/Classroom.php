<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $table = 'classrooms';
    protected $fillable = ["name", "department_id", "monitor_id"];

    // relationship between Classrooms and Department
    public function department()
    {

        return $this->belongsTo(Department::class);
    }

    //one to many relationship between subjects and classroom
    public function subjects()
    {

        return $this->hasMany(Subject::class, 'classroom_id', 'id');
    }

    // many to many relationship between teacher and classroom
    public function teachers()
    {

        return $this->belongsToMany(Teacher::class, 'teacher_classrooms', 'classroom_id', 'teacher_id');
    }
    // relationship between students and classroom
    public function students()
    {

        return $this->hasMany(Student::class, 'classroom_id', 'id');
    }
    
}
