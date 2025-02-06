<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    //
    protected $guarded=[];

    protected $casts = [
        'parcel_car_ids'=>'array'
    ];

    public function setParcelCarIdsAttribute($value)
    {
        $this->attributes['parcel_car_ids'] = is_array($value) ? collect($value) : $value;
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
