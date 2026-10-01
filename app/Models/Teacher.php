<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    // Menghubungkan fitur Soft Delete ke kolom 'archived'
    const DELETED_AT = 'archived';

    protected $table = 'tbl_teachers';
    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'user_id',
        'nip',
        'full_name',
        'email',
        'phone',
        'subject_id',
    ];

    // Relasi ke User (Akun Login)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke Mata Pelajaran
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    // Accessor pendukung (Fallback membaca full_name terlebih dahulu)
    public function getFullNameAttribute()
    {
        return $this->attributes['full_name'] ?? $this->attributes['name'] ?? null;
    }
}
