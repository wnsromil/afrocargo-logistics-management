<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelPickupDriver extends Model
{
    use HasFactory;

    protected $table = 'parcel_pickup_driver';

    protected $fillable = [
        'parcel_id',
        'item_name',
        'img',
        'quantity',
        'quantity_type',
        'is_deleted',
        'driver_id',
        'container_id',
        'container_move_id',
        'move'
    ];

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
