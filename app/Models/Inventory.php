<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Inventory extends Model
{
    //
    protected $guarded = [];

    // protected $appends = ['formatted_created_at'];

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->format('d-m-Y') : '-';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

    public function cart(){
        return $this->belongsTo(Cart::class,'id','product_id');
    }

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? url($value):null,
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
        // Get the last inventory record with status 'Active', ordered by unique_id
        $lastInventory = Inventory::where('status', 'Active')
            ->orderByDesc('unique_id')
            ->first();
    
        // Get the last number from unique_id (assuming it follows the format "TIT-XXXXXX")
        $lastNumber = 0;
        if ($lastInventory && preg_match('/(\d+)$/', $lastInventory->unique_id, $matches)) {
            $lastNumber = (int)$matches[0];
        }
    
        // Increment the number for the new unique_id
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    
        // Return the generated unique_id with TIT- prefix
        return 'TIT-' . $newNumber;
    }
    
}
