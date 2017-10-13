<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftAllocation extends Model
{
    protected $table='shift_allocations';
    public $timestamps = true;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo('App\Models\Shifts', 'shift_id', 'id');
    }
}
