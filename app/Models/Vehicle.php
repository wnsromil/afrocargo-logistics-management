<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //

    protected $guarded = [];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function parcelsCount()
    {
        return $this->hasMany(Parcel::class, 'container_id')
            ->selectRaw('container_id, COUNT(*) as count')
            ->groupBy('container_id');
    }
}
