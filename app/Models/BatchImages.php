<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchImages extends Model
{
    protected $table = 'batch_images';
    public $timestamps = true;
    protected $guarded = ['id'];

    public function images()
    {
        $this->hasOne('App\Models\Images', 'id', 'image_id');
    }
}
