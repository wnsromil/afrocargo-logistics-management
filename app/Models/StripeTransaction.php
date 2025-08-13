<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StripeTransaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'amount',
        'currency',
        'status',
        'email',
        'payment_method',
        'raw_data',
        'user_id',
        'order_id',
        'order_type',
        'warehouse_id'
    ];

     public function customer(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function parcel(){
        return $this->belongsTo(Parcel::class,'order_id');
    }

      public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
