<?php
include('timeSlot.php');
use App\Helpers\SettingsHelper;


function isActive($urls, $class = 'active',$default='')
{
    
    if (!is_array($urls)) {
        $urls = explode(',',$urls);
        if(count($urls) > 1){
            foreach ((array) $urls as $url) {
                if (request()->is($url)) {
                    return $class;
                }
            }
        }
        if (request()->is($urls[0])) {
            return $class;
        }
    }
    foreach ((array) $urls as $url) {
        if (request()->is($url)) {
            return $class;
        }
    }
    return $default;
}

function activeStatusKey($statusName = 'Pending') {
    
    $parcelStatuses = collect([
        'pending'                => 'Pending',
        'pickup_assign'          => 'Pickup Assign',//admin
        'pickup_reschedule'      => 'Pickup Re-Schedule',
        'received_by_pickup_man' => 'Received By Pickup Man',
        'received_warehouse'     => 'Received Warehouse',
        'transfer_to_hub'        => 'Transfer to Hub',
        'received_by_hub'        => 'Received by Hub',
        'delivery_man_assign'    => 'Delivery Man Assign',
        'return_to_courier'      => 'Return to Courier',
        'delivered'              => 'Delivered',
        'cancelled'              => 'Cancelled',
        'created'                => 'Created',
        'updated'                => 'Updated',
        'deleted'                => 'Deleted',
        'archived'               => 'Archived',
        'rejected'               => 'Rejected',
        'completed'              => 'Completed',
        'on_hold'                => 'On Hold',
        'partial'                => 'Partial',
    ]);

    // Return the key if found, or 'pending' if not.
    return str_replace(' ','_',strtolower($statusName));
}


function calculatePrice($value=0,$Unit=0,$Rate=0)
{
    // value-based calculation
    return ceil($value / $Unit) * $Rate;
}

function setting(){
    return new SettingsHelper;
}