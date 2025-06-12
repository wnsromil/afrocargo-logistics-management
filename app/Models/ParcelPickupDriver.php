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
    ];
}
