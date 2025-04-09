<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class)->with(['driver', 'customer']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id')->with(['country', 'state', 'city']);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id')->with(['country', 'state', 'city']);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->with(['country', 'state', 'city']);
    }
   


    // Custom Invoice Number Generate karne ke liye
    public static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            // Agar `invoice_no` already set nahi hai to generate karna
            if (!$invoice->invoice_no) {
                // Last Invoice ka number nikalna
                $lastInvoice = self::orderBy('id', 'desc')->first();

                if ($lastInvoice) {
                    // Last invoice_no se number extract karna (e.g., INV-001 → 001)
                    $lastNumber = intval(substr($lastInvoice->invoice_no, 4));

                    // Next Number Generate karna
                    $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

                    $invoice->invoice_no = 'INV-' . $newNumber;
                } else {
                    // Agar koi data nahi hai table me, to INV-001 se start karna
                    $invoice->invoice_no = 'INV-001';
                }
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id')->with(['country', 'state', 'city']);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id')->with(['country', 'state', 'city']);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->with(['country', 'state', 'city']);
    }


}
