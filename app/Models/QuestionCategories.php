<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionCategories
 *
 * @package App\Models
 */
class QuestionCategories extends Model
{
    /**
     * @var string
     */
    protected $table = 'question_categories';
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
    public function course()
    {
        return $this->hasOne('App\Models\Courses', 'id', 'course_id');
    }
}
