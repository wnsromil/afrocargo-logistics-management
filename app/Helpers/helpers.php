<?php
include('timeSlot.php');
include('BarcodeHelper.php');
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

    $newStatusClass = [
        'pending'                => 'labelstatus',
        'pickup_assign'          => 'pickup_assign',//admin
        'pickup_reschedule'      => 'pickup_reschedule',
        'received_by_pickup_man' => 'received_by_pickup_man',
        'received_warehouse'     => 'received_warehouse',
        'received_by_warehouse'  => 'bg-set',
        'transfer_to_hub'        => 'transfer_to_hub',
        'received_by_hub'        => 'received_by_hub',
        'delivery_man_assign'    => 'delivery_man_assign',
        'assign_delivery_boy'    => 'labelstatuspi',
        'return_to_courier'      => 'return_to_courier',
        'delivered'              => 'delivered',
        'cancelled'              => 'cancelled',
        'created'                => 'created',
        'updated'                => 'updated',
        'deleted'                => 'Deleted',
        'archived'               => 'deleted',
        'rejected'               => 'rejected',
        'completed'              => 'completed',
        'on_hold'                => 'on_hold',
        'partial'                => 'partial',
        'unpaid'                 => 'labelstatus',
        'partialy_paid'          => 'labelstatusy',
        'paid'                   => 'labelstatusw',
    ];

    return $newStatusClass[strtolower($statusName)] ?? '';
    // Return the key if found, or 'pending' if not.
    return str_replace(' ','_',strtolower($statusName));
}


function calculatePrice($value=0,$Unit=0,$Rate=0)
{
    // value-based calculation
    return ceil($value / $Unit) * $Rate;
}

function setting(){
    return new SettingsHelper();
}

function carbon() {
    return new \Carbon\Carbon();
}

function sum(...$numbers) {
    return array_sum($numbers);
}

function removePart(string $subject,
                    string $needle,
                    bool   $caseInsensitive = false,
                    bool   $firstOnly       = false): string
{
    if ($needle === '') {
        // Nothing to remove; avoid an infinite loop.
        return $subject;
    }

    if ($firstOnly) {
        // Build a regex that escapes special chars in $needle.
        $pattern = '/' . preg_quote($needle, '/') . '/' . ($caseInsensitive ? 'i' : '');
        // Replace only the first hit.
        return preg_replace($pattern, '', $subject, 1);
    }

    // Remove ALL occurrences with the appropriate replace.
    return $caseInsensitive
        ? str_ireplace($needle, '', $subject)
        : str_replace($needle, '', $subject);
}

function getStepArray($input,$steps = [10, 20, 50, 100, 200, 500, 1000, 2000, 5000, 10000]) {
    $result = [];

    for ($i = 0; $i < count($steps); $i++) {
        array_push($result, $steps[$i]);
        if ($steps[$i] >= $input) break;
    }

    return $result;
}

