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
            // Defaults
            $rolePrefix = 'V';
            if ($vehicle->vehicle_type === 'Container') {
                $rolePrefix = 'C';
            }
    
            // Get country ISO based on warehouse_id (if provided)
            $countryIso = 'XX';
            if (!empty($vehicle->warehouse_id)) {
                $warehouse = \App\Models\Warehouse::find($vehicle->warehouse_id);
                if ($warehouse && !empty($warehouse->country_id)) {
                    $country = \App\Models\Country::find($warehouse->country_id);
                    if ($country && !empty($country->iso2)) {
                        $countryIso = strtoupper($country->iso2);
                    }
                }
            }
    
            $fullPrefix = $rolePrefix . $countryIso . '-';
    
            // Get last vehicle with similar prefix
            $lastVehicle = self::where('unique_id', 'like', $rolePrefix . '%')
                ->selectRaw("MAX(CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)) as max_number")
                ->value('max_number') ?? 0;
    
            $newNumber = str_pad($lastVehicle + 1, 6, '0', STR_PAD_LEFT);
    
            $vehicle->unique_id = $fullPrefix . $newNumber;
        });
    }
    
}
