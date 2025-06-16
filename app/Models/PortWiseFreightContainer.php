<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortWiseFreightContainer extends Model
{
    //
    protected $fillable = [
        'port_freight_id',
        'container_size_id',
        'freight_price',
        'currency',
    ];

    public function portFreight()
    {
        return $this->belongsTo(PortWiseFreight::class, 'port_freight_id');
    }
}
