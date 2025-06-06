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
            ->where('status', 4)
            ->groupBy('container_id');
    }


    public function parcels()
    {
        return $this->hasMany(Parcel::class, 'container_id', 'id');
    }

    public function gateInDriver()
    {
        return $this->belongsTo(User::class, 'gate_in_driver_id');
    }
    public function gateOutDriver()
    {
        return $this->belongsTo(User::class, 'gate_out_driver_id');
    }

    public function containerStatus()
    {
        return $this->hasOne(ParcelStatus::class, 'id', 'container_status');
    }

    public function containerCompany()
    {
        return $this->belongsTo(ContainerCompany::class, 'container_company_id');
    }

    public function ContainerSize()
    {
        return $this->belongsTo(ContainerSize::class, foreignKey: 'container_size');
    }


    public function brokerData()
    {
        return $this->belongsTo(Broker::class, 'broker');
    }


    public function getVehicleTypeAttribute($value)
    {
        if ($this->relationLoaded('type') && $this->type) {
            return $this->type->name;
        }

        $type = VehicleType::find($value);
        return $type ? $type->name : null;
    }

    protected static function booted()
    {
        static::creating(function ($vehicle) {

            // Defaults
            $rolePrefix = 'V';
            if ($vehicle->vehicle_type == 'Container') {
                $rolePrefix = 'CN';
            }

            // Get country ISO based on warehouse_id (if provided)
            $countryIso = 'XX';

            if (!empty($vehicle->warehouse_id)) {
                $warehouse = \App\Models\Warehouse::find($vehicle->warehouse_id);
                if ($warehouse && !empty($warehouse->country_id)) {
                    $country = \App\Models\Country::where('name', $warehouse->country_id)->first();
                    if ($country && !empty($country->iso2)) {
                        $countryIso = strtoupper($country->iso2);
                    }
                }
            }

            $fullPrefix = $rolePrefix . $countryIso . '-';

            if ($vehicle->vehicle_type == 'Container') {
                // Normal Container logic, max number extract as usual
                $lastNumber = self::where('vehicle_type', 1)
                    ->selectRaw("MAX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(unique_id, '-', -2), '-', 1) AS UNSIGNED)) as max_number")
                    ->value('max_number') ?? 0;
            } else {
                // Custom logic: skip last if vehicle_type == 1
                $lastValid = self::orderByDesc('id')
                    ->skip(1) // Skip the last row
                    ->first(); // Get second last

                // But if lastValid is still type 1, then go further back
                if ($lastValid && $lastValid->vehicle_type == 1) {
                    $lastValid = self::where('vehicle_type', '!=', 1)
                        ->orderByDesc('id')
                        ->first();
                }

                // Extract number
                if ($lastValid && preg_match('/-(\d+)-/', $lastValid->unique_id, $matches)) {
                    $lastNumber = (int) $matches[1];
                } else {
                    $lastNumber = 0;
                }
            }

            $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
            // Final unique ID
            if ($vehicle->vehicle_type == 'Container') {
                $yearSuffix = date('y'); // last 2 digits of year
                $vehicle->unique_id = $fullPrefix . $newNumber . '-' . $yearSuffix;
            } else {
                $vehicle->unique_id = $fullPrefix . $newNumber;
            }
        });
    }
}
