<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Classes
 *
 * @package App
 */
class Batches extends Model
{
    /**
     * @var string
     */
    protected $table = 'batches';
    /**
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * @var bool
     */
    protected $timestamp = true;
    //protected $fillable = ['class_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Models\Students', 'batch_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
       return $this->belongsToMany('App\Models\images', 'batch_images', 'batch_id', 'image_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYears', 'academic_year_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courses()
    {
        return $this->belongsTo('App\Models\Courses', 'course_id', 'id');
    }

}
