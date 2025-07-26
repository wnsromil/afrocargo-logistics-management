<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Category,
};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Parcel extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'parcel_car_ids' => 'array',
        'customer_subcategories_data' => 'array',
        'driver_subcategories_data' => 'array',
        'pickup_address_id' => 'integer',
        'delivery_address_id' => 'integer',
        'pickup_time' => 'string',
        'pickup_date' => 'date',
        'delivery_date' => 'date',
        'delivery_type' => 'string',
        'pickup_type' => 'string',
    ];

    protected $appends = ['category_names'];

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

    public function container()
    {
        return $this->belongsTo(Vehicle::class, 'container_id');
    }

    public function arrivedDriver()
    {
        return $this->belongsTo(User::class, 'arrived_driver_id')->with(['country', 'state', 'city']);
    }

    public function ship_customer()
    {
        return $this->belongsTo(User::class, 'ship_customer_id')->with(['country', 'state', 'city']);
    }

    public function driver_vehicle()
    {
        return $this->hasOne(Vehicle::class, 'driver_id', 'driver_id');
    }

    public function arrivedDriverVehicle()
    {
        return $this->belongsTo(Vehicle::class, 'arrived_driver_id', 'driver_id');
    }


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->with(['country', 'state', 'city']);
    }

    // Parcel model
    public function arrivedWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'arrived_warehouse_id')->with(['country', 'state', 'city']);
    }

    public function pickupaddress()
    {
        return $this->belongsTo(Address::class, 'pickup_address_id')->with(['user', 'country', 'city', 'state']);
    }

    public function deliveryaddress()
    {
        return $this->belongsTo(Address::class, 'delivery_address_id')->with(['user', 'country', 'city', 'state']);
    }

    public function getCategoryNamesAttribute()
    {
        $ids = $this->parcel_car_ids ?? []; // Ensure it's an array

        if (!is_array($ids)) {
            $ids = json_decode($ids, true) ?? []; // Decode JSON if needed
        }

        return count($ids) > 0 ? Category::whereIn('id', $ids)->pluck('name')->toArray() : [];
    }

    protected function driverParcelImage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url($value),
        );
    }

    public function setCustomerSubcategoriesDataAttribute($value)
    {
        // Ensure value is an array before encoding
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        $this->attributes['customer_subcategories_data'] = json_encode($value ?? []);
    }

    public function setDriverSubcategoriesDataAttribute($value)
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        $this->attributes['driver_subcategories_data'] = json_encode($value ?? []);
    }

    public function parcelStatus()
    {
        return $this->belongsTo(ParcelStatus::class, 'status');
    }

    public function ParcelInventory()
    {
        return $this->hasMany(ParcelInventorie::class, 'parcel_id', 'id')->with('barcode','container:id,unique_id,container_no_1,ship_to_country','parcelStatus')->select(
            'id',
            'inventorie_id as supply_id',
            'parcel_id',
            'invoice_id',
            'inventorie_id',
            'inventory_name as supply_name',
            'inventorie_item_quantity as qty',
            'label_qty',
            'price',
            'ins',
            'tax',
            'discount',
            'total',
            'created_at',
            'updated_at',
            'img',
            'quantity_type',
            'status',
            'container_id',
        );
    }
}
