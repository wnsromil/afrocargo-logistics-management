<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortSingleShippingContainerProduct extends Model
{
    //

    protected $fillable = [
        'port_single_shipping_container_id',
        'product_name',
        'description',
        'total_quantity',
        'dimensions_in',
        'breadth',
        'length',
        'height',
        'product_weight_type',
        'product_weight',
        'qty_pack',
        'packing_weight_type',
        'packing_weight',
        'total_cartons',
        'single_CBM',
        'total_CBM',
        'net_weight_kg',
        'gross_weight_kg',
        'total_net_weight_kg',
        'total_gross_weight_kg',
    ];
}
