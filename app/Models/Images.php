<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    public $timestamps = true;
    protected $guarded = ['id'];
}
