<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HubTracking extends Model
{
    //

    protected $guarded =[];

    // Mutator to set a default tracking number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($parcel) {
            if (empty($parcel->tracking_id)) {
                $parcel->tracking_id = 'ACE-HB_' . strtoupper(Str::random(6));
            }
        });
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by')->with(['country','state','city']);
    }
    public function parcels(){
        return $this->hasMany(Parcel::class,'hub_tracking_id');
    }
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id')->with(['country','state','city']);
    }
    public function toWarehouse()
    {
        return $this->belongsTo(Warehouse::class,'to_warehouse_id')->with(['country','state','city']);
    }
    public function fromWarehouse()
    {
        return $this->belongsTo(Warehouse::class,'from_warehouse_id')->with(['country','state','city']);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

}
