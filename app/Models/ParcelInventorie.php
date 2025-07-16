<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParcelInventorie extends Model
{
    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'parcel_id',
        'inventorie_id',
        'inventorie_item_quantity',
        'inventory_name',
        'invoice_id',
        'label_qty',
        'price',
        'discount',
        'ins',
        'tax',
        'total',
        'container_id',
        'container_move_id',
        'move',
        'img',
        'is_deleted',
        'driver_id',
        'status',
        'delivered',
        'quantity_type',
    ];

    // Define relationships
    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public function inventorie()
    {
        return $this->belongsTo(Inventory::class, 'inventorie_id');
    }

    public function barcode()
    {
        return $this->belongsTo(Barcode::class, 'supply_id', 'id');
    }

    public function parcelStatus()
    {
        return $this->belongsTo(ParcelStatus::class, 'status');
    }

    public function container()
    {
        return $this->hasOne(Vehicle::class, 'id', 'container_id'); // ya hasMany agar ek se zyada ho
    }

    public function moveContainer()
    {
        return $this->hasOne(Vehicle::class, 'container_move_id'); // ya hasMany agar ek se zyada ho
    }
}
