<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYears extends Model
{
    protected $table = 'academic_years';
    public $timestamps = true;
    protected $guarded = ['id'];
}
