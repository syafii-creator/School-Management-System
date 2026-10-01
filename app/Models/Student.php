<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    // Menghubungkan fitur Soft Delete ke kolom 'archived'
    const DELETED_AT = 'archived';

    protected $table = 'tbl_students';
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'user_id',
        'full_name',
        'nis',
        'class_id',
        'date_of_birth',
    ];

    // Relasi ke User (Akun Login)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke Kelas (Dipanggil di Controller & View Blade)
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'class_id');
    }

    // Alias relasi kelas
    public function class()
    {
        return $this->schoolClass();
    }
}
