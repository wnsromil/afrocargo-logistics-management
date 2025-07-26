<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        'invoce_item' => 'array',
        'currentdate'=>'date'
    ];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id');
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(Address::class, 'delivery_address_id')->with(['user']);
    }

    public function pickupAddress()
    {
        return $this->belongsTo(Address::class, 'pickup_address_id')->with(['user']);
    }


    public function invoiceParcelData()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id')
            ->with(['arrivedWarehouse','driver' => function ($query) {
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

    public function ParcelInventory()
    {
        return $this->hasMany(ParcelInventorie::class, 'invoice_id', 'id')->select(
            'id',
            'inventorie_id as supply_id',
            'inventory_name as supply_name',
            'parcel_id',
            'invoice_id',
            'inventorie_id',
            'inventorie_item_quantity as qty',
            'label_qty',
            'volume',
            'value',
            'price',
            'ins',
            'tax',
            'discount',
            'total',
            'created_at',
            'updated_at'
        );
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

    public static function getNextInvoiceNumber()
    {
        $lastInvoice = self::orderBy('id', 'desc')->first();

        if ($lastInvoice) {
            $lastNumber = intval(substr($lastInvoice->invoice_no, 4));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            return 'INV-' . $newNumber;
        }

        return 'INV-001';
    }


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->with('signature');
    }

    public function container()
    {
        return $this->belongsTo(Vehicle::class,'container_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id','name','last_name','role','role_id');
    }
    public function comments()
    {
        return $this->hasMany(InvoiceComment::class, 'invoice_id')->where('is_deleted', false)->where('is_active', true)
            ->with(['createdByUser' => function ($query) {
                $query->select('id', 'name', 'last_name');
            }]);
    }
    public function individualPayment()
    {
        return $this->hasMany(IndividualPayment::class, 'invoice_id')
            ->with(['createdByUser' => function ($query) {
                $query->select('id', 'name', 'last_name');
            }]);
    }

    public function barcodes()
    {
        return $this->hasMany(Barcode::class, 'invoice_id')->with('ParcelInventory');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class, 'invoice_id')->with(['user']);
    }
    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by')->select('id', 'name', 'last_name','role','role_id');
    }
}
