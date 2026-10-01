<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Tambahkan ini

class User extends Authenticatable
{
    use Notifiable, SoftDeletes; // 2. Tambahkan SoftDeletes di sini

    const DELETED_AT = 'archived'; // 3. Arahkan ke kolom archived

    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id'; // Sesuaikan primary key jika ada

    // ... sisa kode model User tetap sama ...


    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi One-to-One ke Student
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'user_id');
    }

    // Relasi One-to-One ke Teacher
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id', 'user_id');
    }
}
