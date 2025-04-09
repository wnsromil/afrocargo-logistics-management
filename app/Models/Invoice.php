<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    // App\Models\Invoice.php

    public function parcel()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id');
    }


    public function invoiceParcelData()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id')
            ->select([
                'id',
                'customer_id',
                'ship_customer_id',
                'driver_id',
                'driver_subcategories_data',
                'total_amount',
                'estimate_cost',
                'container_id',
                'percel_comment'
            ])->with(['driver' => function ($query) {
                return $query->select([
                    'id',
                    'name',
                    'last_name',
                    'email',
                    'phone',
                    'country_code',
                    'phone_2',
                    'country_code_2',
                    'address',
                    'address_2',
                ]);
            }, 'customer' => function ($query) {
                return $query->select([
                    'id',
                    'name',
                    'last_name',
                    'email',
                    'phone',
                    'country_code',
                    'phone_2',
                    'country_code_2',
                    'address',
                    'address_2',
                ]);
            }, 'ship_customer' => function ($query) {
                return $query->select([
                    'id',
                    'name',
                    'last_name',
                    'email',
                    'phone',
                    'country_code',
                    'phone_2',
                    'country_code_2',
                    'address',
                    'address_2',
                ]);
            }]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
