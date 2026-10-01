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
    ];

    // Relasi ke Model Teacher (Wali Kelas)
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id', 'teacher_id');
    }

    // Alias relasi untuk wali kelas agar dipanggil homeroomTeacher
    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id', 'teacher_id');
    }

    // Relasi ke Model Student
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'class_id');
    }
}
