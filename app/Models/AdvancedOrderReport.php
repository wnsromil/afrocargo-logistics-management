<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancedOrderReport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advanced_order_reports';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // List all the columns from your view that you want to be fillable
        'id',
        'user_name',
        'email',
        'role_id',
        'role',
        'address',
        'mobile_number',
        'alternative_mobile_number',
        'address_type',
        'full_name',
        'order_status',
        'generated_by',
        'issue_date',
        'parcel_id',
        'user_id',
        'invoice_total_amount',
        'is_paid',
        'vehicle_number',
        'vehicle_model',
        'vehicle_type',
        'ship_user_name',
        'ship_email',
        'ship_role_id',
        'ship_role',
        'ship_address',
        'ship_mobile_number',
        'ship_alternative_mobile_number',
        'ship_address_type',
        'ship_full_name',
        // Add all other fields from your view
    ];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function driver(){
        return $this->belongsTo(User::class,'driver_id');
    }

    public function expenses(){
        return $this->hasMany(Expense::class,'creator_user_id','user_main_id');
    }
}
