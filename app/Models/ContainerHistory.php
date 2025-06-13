<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerHistory extends Model
{
    use HasFactory;

    protected $table = 'container_history';

    protected $fillable = [
        'container_id',
        'transfer_date',
        'no_of_orders',
        'driver_id',
        'total_amount',
        'partial_payment',
        'remaining_payment',
        'status',
        'description',
        'warehouse_id',
        'arrived_warehouse_id',
        'note',
        'type',
        'open_date',
        'close_date'

    ];

    // Relationship with Container
    public function container()
    {
        return $this->belongsTo(Vehicle::class, 'container_id');
    }

    // Relationship with Driver (assuming driver is a user with role_id = 4)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function containerStatus()
    {
        return $this->hasOne(ParcelStatus::class,'id', 'status');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function arrived_warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'arrived_warehouse_id');
    }
}
