<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'driver_id',
        'in_out',
        'items_id',
        'quantity',
        'time',
        'creator_id',
        'warehouse_id'
    ];

    public function items()
    {
        return $this->belongsTo(Inventory::class, 'items_id');
    }


    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
