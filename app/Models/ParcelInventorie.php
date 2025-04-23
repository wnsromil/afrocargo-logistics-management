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
}