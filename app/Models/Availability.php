<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    //
    protected $guarded=[];

    public function locationSchedule()
    {
        return $this->belongsTo(LocationSchedule::class, 'user_id', 'user_id');
    }

    public function locationName()
    {
        return $this->hasOne(LocationSchedule::class, 'id', 'location_id');
    }
}
