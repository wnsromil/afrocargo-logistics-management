<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Category,
};

class Parcel extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'parcel_car_ids' => 'array'
    ];


    // Mutator to set a default tracking number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($parcel) {
            if (empty($parcel->tracking_number)) {
                $parcel->tracking_number = 'ACE-' . strtoupper(Str::random(8));
            }
        });
    }

    public function setParcelCarIdsAttribute($value)
    {
        $this->attributes['parcel_car_ids'] = is_array($value) ? collect($value) : $value;
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id')->with(['country', 'state', 'city']);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id')->with(['country', 'state', 'city']);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->with(['country', 'state', 'city']);
    }

    public function getCategoryNamesAttribute()
    {
        return Category::whereIn('id', $this->parcel_car_ids)->pluck('name')->toArray();
    }
}
