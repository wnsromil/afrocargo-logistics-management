<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    //

    protected $guarded = [];


    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id');
    }

    public function ParcelInventory()
    {
        return $this->hasOne(ParcelInventorie::class, 'id','supply_id')->select(
            'id',
            'id as supply_id',
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
            'updated_at'
        );
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
