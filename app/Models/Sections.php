<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sections
 *
 * @package App\Models
 */
class Sections extends Model
{
    /**
     * @var string
     */
    protected $table = 'sections';
    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var array
     */
    protected $guarded = ['id'];

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
    public function batch()
    {
        return $this->belongsTo('App\Models\Batches', 'batch_id', 'id');
    }
}
