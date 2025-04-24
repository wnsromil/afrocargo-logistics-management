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
        'status',
        'time',
        'img', // Image path
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
}