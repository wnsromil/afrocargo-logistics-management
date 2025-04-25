<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //

    protected $fillable = [
        'vehicle_type', // other fields you have in the vehicle model
        // add other fillable fields
    ];


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

    protected static function booted()
    {
        static::creating(function ($vehicle) {
            // Check the vehicle type and generate unique_id accordingly
            if ($vehicle->vehicle_type == 'Container') {
                // For 'Container', prefix will be 'CTN-'
                $prefix = 'CTN-';
            } else {
                // For other vehicle types, prefix will be 'VHL-'
                $prefix = 'VHL-';
            }

            // Get the last inserted id and increment the count for unique_id
            $lastVehicle = self::where('vehicle_type', $vehicle->vehicle_type)
                               ->latest('id')
                               ->first();

            // If no vehicle exists, start from 1
            $lastCount = $lastVehicle ? (int) substr($lastVehicle->unique_id, -6) : 0;

            // Increment the count, but if no vehicles exist, start at 1
            $vehicle->unique_id = $prefix . str_pad($lastCount + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}
