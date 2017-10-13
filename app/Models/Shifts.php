<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $table = 'shifts';
    public $timestamps = true;
    protected $guarded = ['id'];

}
