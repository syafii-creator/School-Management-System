<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    const DELETED_AT = 'archived';

    protected $table = 'tbl_classes';
    protected $primaryKey = 'class_id';

    protected $fillable = [
        'class_name',
        'academic_year',
        'homeroom_teacher_id', // Gunakan homeroom_teacher_id
    ];

    // Relasi ke Model Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id', 'teacher_id');
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id', 'teacher_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'class_id');
    }
}
