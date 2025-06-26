<?php

use App\Models\DriverInventory;
use App\Models\DriverInventoriesSolde;
use App\Models\Address;

if (!function_exists('calculateDriverInventoryDetails')) {
    function calculateDriverInventoryDetails($driverInventoryId)
    {
        $driverInventory = DriverInventory::find($driverInventoryId);

        if (!$driverInventory) {
            return [
                'DriverInventory_quantity_total' => 0,
                'DriverInventoriesSolde_quantity' => 0,
                'remaining_quantity' => 0,
                'DriverInventory_quantity_out' => 0,
                'DriverInventory_quantity_in' => 0,
            ];
        }

        $DriverInventory_quantity_out = 0;
        $DriverInventory_quantity_in = 0;

        // Check just this entry's in_out
        if ($driverInventory->in_out === 'Out') {
            $DriverInventory_quantity_out = $driverInventory->quantity ?? 0;
        } elseif ($driverInventory->in_out === 'In') {
            $DriverInventory_quantity_in = $driverInventory->quantity ?? 0;
        }

        $DriverInventory_quantity_total = $DriverInventory_quantity_out - $DriverInventory_quantity_in;

        // Get only sold quantity related to this inventory row
        $DriverInventoriesSolde_quantity = DriverInventoriesSolde::where('driver_inventories_id', $driverInventoryId)
            ->sum('quantity');

        $remaining_quantity = $DriverInventory_quantity_total - $DriverInventoriesSolde_quantity;

        return [
            'DriverInventory_quantity_total' => $DriverInventory_quantity_total,
            'DriverInventoriesSolde_quantity' => $DriverInventoriesSolde_quantity,
            'remaining_quantity' => $remaining_quantity,
            'DriverInventory_quantity_out' => $DriverInventory_quantity_out,
            'DriverInventory_quantity_in' => $DriverInventory_quantity_in,
        ];
    }
}
function checkExpiryStatus($date, $type = null)
{
    if (!$date) {
        return null;
    }

    $expiryDate = \Carbon\Carbon::parse($date);
    $today = \Carbon\Carbon::today();

    $daysRemaining = $today->diffInDays($expiryDate, false);

    // Agar 0 ya negative hai to already expired bhi show karega
    if ($daysRemaining <= 30) {
        $response = [
            'bg_class' => 'expiry_date_bg_alert',
            'text_class' => 'expiry_date_text_alert',
        ];

        if ($type) {
            $labels = [
                'licence_plate_exp_date' => 'License plate expiry',
                'vehicle_registration_exp_date' => 'Vehicle registration expiry',
                'vehicle_insurance_exp_date' => 'Insurance expiry',
                'license_expiry_date' => 'License expiry',
            ];

            $label = $labels[$type] ?? 'Document expiry';
            $response['message'] = "$label in {$daysRemaining} days";
        }

        return $response;
    }

    return null; // agar 30 din se zyada time hai to kuch return na kare
}

function checkVehicleExpiryStatus($plateDate, $registrationDate, $insuranceDate)
{
    $dates = [
        'License Plate' => ['date' => $plateDate, 'type' => 'licence_plate_exp_date'],
        'Registration' => ['date' => $registrationDate, 'type' => 'vehicle_registration_exp_date'],
        'Insurance' => ['date' => $insuranceDate, 'type' => 'vehicle_insurance_exp_date'],
    ];

    $results = [];

    foreach ($dates as $label => $info) {
        $result = checkExpiryStatus($info['date'], $info['type']);
        if ($result && isset($result['message'])) {
            $results[] = [
                'label' => $label,
                'message' => $result['message'],
                'bg_class' => $result['bg_class'] ?? 'expiry_date_bg_alert',
                'text_class' => $result['text_class'] ?? 'expiry_date_text_alert',
            ];
        }
    }

    return $results; // Multiple cards ke liye
}

function insertAddress(array $data)
{
    // Step 1: Merge default values for new columns if not provided
    $data['type'] = $data['type'] ?? 'Services';
    $data['default_address'] = $data['default_address'] ?? 'No';

    // Step 2: Insert into addresses table
    Address::create($data);
}

function updateAddress(int $id, array $data)
{
    // Step 2: Find the address by ID
    $address = Address::where('user_id', $id)->where('default_address', 'Yes')->first();

    if ($address) {
        // Step 3: Update the address
        $address->update($data);
    }
}
