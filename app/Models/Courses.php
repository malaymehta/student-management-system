<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table='courses';
    public $timestamps = true;
    protected $guarded = ['id'];
}
