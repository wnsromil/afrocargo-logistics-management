<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPickupDetail extends Model
{
    // app/Models/UserPickupDetail.php

    protected $fillable = [
        'parent_customer_id',
        'pickup_address_id',
        'shipto_address_id',
        'Item1',
        'Item2',
        'pickup_delivery',
        'Status',
        'Date',
        'Time',
        'Done_Date',
        'Zone',
        'Driver_id',
        'Note',
        'Box_quantity',
        'Barrel_quantity',
        'Tapes_quantity',
        'pickup_type',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'Driver_id');
    }
    public function parentCustomer()
    {
        return $this->belongsTo(User::class, 'parent_customer_id');
    }
    public function pickupAddress()
    {
        return $this->belongsTo(User::class, 'pickup_address_id');
    }
    public function shiptoAddress()
    {
        return $this->belongsTo(User::class, 'shipto_address_id');
    }

    //
}
