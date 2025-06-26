<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'warehouse_id', // Warehouse relationship
        'date',
        'description',
        'amount',
        'category',
        'creator_user_id', // User relationship
        'creator_id',
        'container_id',
        'status',
        'time',
        'img', // Image path
        'type',
        'currency',
    ];

    /**
     * Relationship: Get the user who created the expense.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    /**
     * Relationship: Get the warehouse associated with the expense.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
        // Get the last expense record, ordered by unique_id
        $lastExpense = Expense::orderByDesc('unique_id')->first();

        // Get the last number from unique_id (assuming it follows the format "TEX-XXXXXX")
        $lastNumber = 0;
        if ($lastExpense && preg_match('/(\d+)$/', $lastExpense->unique_id, $matches)) {
            $lastNumber = (int)$matches[0];
        }

        // Increment the number for the new unique_id
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        // Return the generated unique_id with TEX- prefix
        return 'TEX-' . $newNumber;
    }
}