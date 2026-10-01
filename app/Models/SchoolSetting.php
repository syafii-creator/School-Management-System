<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    protected $table = 'tbl_school_settings';
    protected $primaryKey = 'school_id';

    protected $fillable = [
        'school_name',
        'npsn',
        'address',
        'phone',
        'email',
        'academic_year',
        'semester',
    ];
}
