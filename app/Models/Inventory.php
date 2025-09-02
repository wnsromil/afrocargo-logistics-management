<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Inventory extends Model
{

    protected $fillable = [
        'warehouse_id',
        'category_id',
        'inventory_type',
        'inventary_sub_type',
        'barcode_have',
        'package_type',
        'retail_shipping_price',
        'description',
        'driver_app_access',
        'country',
        'state_zone',
        'item_length_inch',
        'weight',
        'width',
        'height',
        'weight_price',
        'volume_total',
        'volume_price',
        'factor',
        'insurance_have',
        'insurance',
        'qty_on_hand',
        'retail_vaule_price',
        'value_price',
        'last_cost_received',
        're_order_point',
        're_order_quantity',
        'last_date_received',
        'tax_percentage',
        'status',
        'total_quantity',
        'in_stock_quantity',
        'low_stock_warning',
        'price',
        'img',
        'name',
        'state',
        'city',
        'color',
        'open',
        'capacity',
        'un_rating',
        'model_number',
        'minimum_order_limit'
    ];


    //
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'warehouse_id' => 'integer',
            'driver_id' => 'integer',
        ];
    }

    // protected $appends = ['formatted_created_at'];

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->format('d-m-Y') : '-';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id', 'product_id');
    }

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? url($value) : null,
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->inventary_sub_type == "Supply" ? $this->retail_vaule_price: $value ?? $this->retail_shipping_price,
        );
    }


    protected static function booted()
    {
        parent::boot();

        static::creating(function ($inventory) {
            // Generate unique_id when creating a new inventory
            $inventory->unique_id = self::generateUniqueId();
        });
    }

    public static function generateUniqueId()
    {
        // Extract the numeric part after the dash and sort numerically
        $lastInventory = Inventory::where('status', 'Active')
            ->selectRaw("CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED) as number_part, unique_id")
            ->orderByDesc('number_part')
            ->first();

        $lastNumber = 0;
        if ($lastInventory) {
            $lastNumber = (int) $lastInventory->number_part;
        }

        $newNumber = (string) ($lastNumber + 1);

        return 'ACE-' . $newNumber;
    }
}
