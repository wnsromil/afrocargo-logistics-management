<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //

    protected $fillable = [
        'vehicle_type', // other fields you have in the vehicle model
        'transfer_date',
        'close_date',
        'note',
        'arrived_warehouse_id',
        'container_status',
        'status',
        // add other fillable fields
    ];



    protected $guarded = [];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function arrived_warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'arrived_warehouse_id');
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

    public function parcels()
    {
        return $this->hasMany(Parcel::class, 'container_id', 'id');
    }

    public function containerStatus()
    {
        return $this->hasOne(ParcelStatus::class,'id', 'container_status');
    }


    protected static function booted()
    {
        static::creating(function ($vehicle) {
            if ($vehicle->vehicle_type == 'Container') {
                $prefix = 'CTN-';

                // Only find last Container
                $lastVehicle = self::where('vehicle_type', 'Container')
                    ->latest('id')
                    ->first();
            } else {
                $prefix = 'VHL-';

                // Find last vehicle which is NOT Container
                $lastVehicle = self::where('vehicle_type', '!=', 'Container')
                    ->latest('id')
                    ->first();
            }

            // Extract last count
            $lastCount = 0;
            if ($lastVehicle) {
                $lastCount = (int) substr($lastVehicle->unique_id, strlen($prefix));
            }

            // Generate new unique_id
            $vehicle->unique_id = $prefix . str_pad($lastCount + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}
