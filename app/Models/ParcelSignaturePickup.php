<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParcelSignaturePickup extends Model
{
    //
    protected $table = 'parcel_signature_pickup';
    protected $fillable = [
        'parcel_id',
        'container_id',
        'img',
        'note',
        'amount',
        'customer_id',
        'delivered',
        'parcel_pickup_id',
        'currency_name',
    ];
    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

}
