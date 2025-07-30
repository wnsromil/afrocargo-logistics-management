<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualPayment extends Model
{
    //
    protected $guarded = [];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }



    protected static function booted()
    {
        parent::boot();

        static::creating(function ($expense) {
            // Generate unique_id when creating a new expense
            $expense->unique_id = self::generateUniqueId();
        });
    }

    public static function generateUniqueId()
    {
        // Get the last expense record, ordered by numeric part of unique_id
        $lastExpense = Expense::selectRaw("CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED) as number_part")
            ->orderByDesc('number_part')
            ->first();

        // Get the last number (default 0 if none)
        $lastNumber = $lastExpense ? (int)$lastExpense->number_part : 0;

        // No zero-padding here
        $newNumber = (string)($lastNumber + 1);

        // Return the generated unique_id
        return 'TIP-' . $newNumber;
    }
}
