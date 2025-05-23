<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverInventoriesSolde extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_inventories_id',
        'driver_id',
        'date',
        'customer_id',
        'invoice_no',
        'type',
        'quantity',
        'price',
        'total',
    ];

    public function items()
    {
        return $this->belongsTo(DriverInventory::class, 'driver_inventories_id');
    }


    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
