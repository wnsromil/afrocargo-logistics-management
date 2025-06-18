<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortSingleShippingContainer extends Model
{
    //
    protected $table = 'port_single_shipping_container';

    protected $fillable = [
        'creator_user_id',
        'calculation',
        'calculation_date',
        'customer_name',
        'container_size_id',
        'port_wise_freights_id',
        'from_country',
        'from_port',
        'to_country',
        'to_port',
        'freight_price',
        'currency',
        'used_volume',
        'used_weight',
    ];
}
