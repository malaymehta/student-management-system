<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CourseScope;

/**
 * Class Students
 *
 * @package App
 */
class Students extends Model
{
    //use softDeletes;

    /**
     * @var string
     */
    protected $table = "students";

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     *
     */
    /*protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CourseScope);
    }*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batches()
    {
        return $this->belongsTo('App\Models\Batches', 'batch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentImages()
    {
        return $this->hasMany('App\Models\StudentImages', 'student_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('App\Models\Images', 'student_images', 'student_id', 'image_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYears', 'academic_year_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Courses', 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('App\Models\Sections', 'section_id');
    }

}
