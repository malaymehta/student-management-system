<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';
    public $timestamps = true;
    protected $guarded = ['id'];
}
