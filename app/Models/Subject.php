<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    // Memberitahu Laravel untuk menggunakan kolom 'archived' (Sesuai Brief Gamelab)
    const DELETED_AT = 'archived';

    protected $table = 'tbl_subjects';
    protected $primaryKey = 'subject_id';

    protected $fillable = [
        'subject_name',
        'subject_code',
        'credits',
        'slug',
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'subject_id', 'subject_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($subject) {
            if (empty($subject->slug) || $subject->isDirty('subject_name')) {
                $subject->slug = Str::slug($subject->subject_name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
