<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuality extends Model
{
    protected $table = 'student_qualities';
    public $timestamps = true;
    protected $guarded = ['id'];

}
