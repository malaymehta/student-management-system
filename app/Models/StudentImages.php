<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentImages
 *
 * @package App\Models
 */
class StudentImages extends Model
{
    /**
     * @var string
     */
    protected $table='student_images';
    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne('App\Models\Images', 'id', 'image_id');
    }
}
