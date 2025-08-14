<?php

namespace App\Helpers;

use App\Models\{
    Setting,
    ParcelStatus,
    Warehouse,
    Country,
    LocationSchedule,
    WeeklySchedule,
    ParcelHistory,
    Invoice,
    InvoiceHistory,
    Parcel,
    ParcelInventorie
};
use Carbon\Carbon;

class SettingsHelper
{
    public static function get($key = null, $default = null)
    {
        // Try to get project-specific setting
        $setting = Setting::where('key', $key)->first();

        // Return setting value or default
        return $setting ? self::formatValue($setting->type, $setting->value) : $default;
    }

    public static function getAll()
    {
        // Return setting value or default
        return Setting::get();
    }

    public static function set($key, $value, $type = 'string', $defaultValue = null)
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value, 'type' => $type, 'default_value' => $defaultValue]
        );
    }

    public static function setGlobal($key, $value, $type = 'string', $defaultValue = null)
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value, 'type' => $type, 'default_value' => $defaultValue]
        );
    }

    public static function statusList()
    {
        return ParcelStatus::get();
    }

    public static function warehouseContries()
    {
        // Get unique country names from warehouses and convert to lowercase, with warehouse ids
        $warehouses = Warehouse::select('id', 'country_id')
            ->where('status', 'Active')
            ->get()
            ->groupBy(function ($item) {
                return strtolower($item->country_id);
            });

        $countryNames = $warehouses->keys();

        // Get countries where LOWER(name) matches any lowercase country_id
        $countries = Country::whereRaw('LOWER(name) IN ("' . $countryNames->implode('","') . '")')
            ->select('id', 'name', 'iso2', 'iso3', 'phonecode', 'currency', 'currency_symbol')
            ->get();

        // Attach warehouse ids to each country
        foreach ($countries as $country) {
            $key = strtolower($country->name);
            $country->warehouse_ids = $warehouses->has($key)
                ? $warehouses[$key]->pluck('id')->values()
                : collect();
        }

        return $countries;
    }

    public static function ActiveWarehouseContries($warehouseId=false)
    {


        // Get countries where LOWER(name) matches any lowercase country_id
        return Warehouse::leftJoin('countries', 'warehouses.country_id', '=', 'countries.name')
            ->where('warehouses.status', 'Active')
            ->select('warehouses.*', 'countries.id as countryId', 'countries.name', 'countries.iso2', 'countries.iso3', 'countries.phonecode', 'countries.currency', 'countries.currency_symbol')
            ->when($warehouseId && is_array($warehouseId),function($q) use($warehouseId){
                return $q->whereIn('warehouses.id',$warehouseId);
            })
            ->get();
    }
    public static function getNearbyWarehouseDriverIds($lat, $lng, $nearestWarehouseId =null, $radius = 50)
    {
        return LocationSchedule::join('users','users.id','=','location_schedules.user_id')
        ->when($nearestWarehouseId,function($q)use($nearestWarehouseId){
            return $q->where('users.warehouse_id',$nearestWarehouseId);
        })
        ->select('user_id')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance',
                [$lat, $lng, $lat]
            )
            ->having('distance', '<=', $radius)
            ->pluck('user_id');
    }


    public static function getDriverTimeSlot($userIds, $dayName = null)
    {
        // If $dayName is null or empty, use current day name in lowercase
        if (empty($dayName)) {
            $dayName = strtolower(Carbon::now()->format('l'));
        }

        // $userIds = self::getNearbyWarehouseDriverIds($lat, $long);

        foreach ($userIds as $userId) {
            $availablePeriods = [];

            // Step 1: Check availability table se user ki entry
            if (isset($availabilities[$userId])) {
                $avail = $availabilities[$userId];
                foreach (['morning', 'afternoon', 'evening'] as $period) {
                    if ($avail->$period == 1) {
                        $availablePeriods[] = $period;
                    }
                }

                // Agar koi period 1 nahi mila, skip this user
                if (empty($availablePeriods)) {
                    continue;
                }
            } else {
                // Step 2: availability record nahi mila => sab periods maan lo
                $availablePeriods = ['morning', 'afternoon', 'evening'];
            }

            // Step 3: Weekly schedule nikaalo
            $weekly = WeeklySchedule::where('user_id', $userId)
                ->where('day', $dayName)
                ->first();

            if (!$weekly) continue;

            // Step 4: time slots banao
            foreach ($availablePeriods as $period) {
                $startField = $period . '_start';
                $endField = $period . '_end';

                if ($weekly->$startField && $weekly->$endField) {
                    $start = Carbon::parse($weekly->$startField);
                    $end = Carbon::parse($weekly->$endField);

                    $current = $start->copy();
                    while ($current->lt($end)) {
                        $next = $current->copy()->addHour();
                        if ($next->gt($end)) break;

                        $slot = $current->format('h:i A') . ' - ' . $next->format('h:i A');
                        $slotsSet[$period][$slot] = true;

                        $current = $next;
                    }
                }
            }
        }

        // Final formatting
        $finalSlots = [];
        foreach (['morning', 'afternoon', 'evening'] as $period) {
            $finalSlots[$period] = isset($slotsSet[$period])
                ? array_keys($slotsSet[$period])
                : [];
        }

        return $finalSlots;
    }

    public static function getLatLngFromLocation($country = '', $state = '', $city = '')
    {
        try {
            //code...

            $apiKey = 'AIzaSyCJFnhTgQa7v75t28FbMgajOv-5mJuMTqI&libraries'; // replace with your actual API key

            // Build the address string
            $addressParts = array_filter([$city, $state, $country]);
            $address = implode(',', $addressParts);
            // dd($address);
            // URL encode the address
            $encodedAddress = urlencode($address);

            // Construct the API URL
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedAddress}&key={$apiKey}";

            // Initialize cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Get response
            $response = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response
            $responseData = json_decode($response, true);

            // Check if results are available
            if (!empty($responseData['status']) && $responseData['status'] == 'OK') {
                $location = $responseData['results'][0]['geometry']['location'];
                return [
                    'lat' => $location['lat'],
                    'lng' => $location['lng']
                ];
            }

            // Return null if no results found
            return null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    private static function formatValue($type, $value)
    {
        switch ($type) {
            case 'integer':
                return (int) $value;
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'json':
                return json_decode($value, true);
            default:
                return $value;
        }
    }

    public static function saveInvoiceHistory($invoice_id, $status, $orderData = [])
    {
        $invoice = Invoice::with(['barcodes','deliveryAddress', 'pickupAddress'])->findOrFail($invoice_id);

        // Create invoice history
        InvoiceHistory::create([
            'invoice_id' => $invoice_id,
            'status' => $status,
            'created_by' => auth()->id(),
            'histry_info' => $invoice // Typo fixed from 'histry_info'
        ]);

        $parcel = null;
        $typeMap = ['services' => 'Service', 'supplies' => 'Supply'];

        $validatedData = [
            'parcel_type' => $typeMap[strtolower($invoice->invoce_type ?? 'service')] ?? 'Service',
            'total_amount' => $invoice->total_amount,
            'partial_payment' => $invoice->total_amount,
            'remaining_payment' => $invoice->total_amount,
            'descriptions' => $invoice->descrition ?? null,
            'weight' => $invoice->weight ?? null,
            'destination_address' => optional($invoice->deliveryAddress)->address,
            'destination_user_name' => optional($invoice->deliveryAddress)->full_name,
            'destination_user_phone' => optional($invoice->deliveryAddress)->mobile_number,
            'pickup_address_id' => optional($invoice->pickupAddress)->id,
            'delivery_address_id' => optional($invoice->deliveryAddress)->id ?? optional($invoice->pickupAddress)->id,
            'ship_customer_id' => optional($invoice->deliveryAddress)->user_id ?? null,
            'pickup_time' => now(),
            'pickup_date' => now(),
            'customer_id' => $invoice->customer_id ?? optional($invoice->pickupAddress)->user_id ?? null,
            'payment_status' => ($invoice->total_amount > 0) ? 'Partial' : 'Paid',
            'invoice_id'=>$invoice_id,
            'status' => 4,
        ];
        if($invoice->transport_type){
            $validatedData['transport_type'] = $invoice->transport_type;
        }

        $validatedData['warehouse_id'] = $invoice->warehouse_id ?? null;

        if (empty($invoice->parcel_id)) {

            $validatedData['weight'] = $orderData['weight'] ?? 0;
            $validatedData['estimate_cost'] = $orderData['estimate_cost'] ?? null;


            // Check if warehouses exist before saving arrived_warehouse_id
            if (!empty($invoice->arrived_warehouse_id) && Warehouse::where('id', $invoice->arrived_warehouse_id)->exists()) {
                $validatedData['arrived_warehouse_id'] = $invoice->arrived_warehouse_id;
            }
            $validatedData['delivery_type'] = 'self';
            $invoice->delivery_type = 'self';
            $validatedData['driver_id'] = $invoice->driver_id ?? null;

            $parcel = Parcel::create($validatedData);

            $invoice->update(['parcel_id' => $parcel->id]);
        } else {
            $parcel = Parcel::find($invoice->parcel_id);

            if(!empty($invoice->arrived_warehouse_id)){
                $validatedData['arrived_warehouse_id'] = $invoice->arrived_warehouse_id;
            }

            $parcel->update($validatedData);
        }
        $qty = 0;


        // Save inventory items to ParcelInventorie
        foreach ($invoice->invoce_item ?? [] as $item) {
            // if(!empty($item['supply_id'])){
            // }

            $qty += $item['qty'] ?? 0;
            $saveData=[
                            'invoice_id' => $invoice->id,
                            'inventorie_item_quantity' => $item['qty'],
                            'inventory_name' => $item['supply_name'],
                            'label_qty' => $item['label_qty'],
                            'price' => $item['price'] ?? 0,
                            'volume' => $item['volume'] ?? 0,
                            'value' => $item['value'] ?? 0,
                            'ins' => $item['ins'] ?? 0,
                            'tax' => $item['tax'] ?? 0,
                            'discount' => $item['discount'] ?? 0,
                            'total' => $item['total'] ?? 0,
                    ];
            if(!empty($item['inventory_id'])){
                $cp = [
                            'parcel_id' => $invoice->parcel_id,
                            'id' => $item['inventory_id'],
                        ];
            }else if(!empty($item['supply_id'])){
                $cp = [
                            'parcel_id' => $invoice->parcel_id,
                            'inventorie_id' => $item['supply_id'],
                        ];
            }else{
                $cp = [
                        'id' => null,
                    ];
                $saveData['parcel_id'] = $invoice->parcel_id;
            }
            $supply =  ParcelInventorie::updateOrCreate(
                        $cp,
                        $saveData
                    );
            if(!empty($invoice->barcodes) && !empty($invoice->transport_type)){
                for ($i=0; $i < $item['qty']; $i++) {
                    store_barcode([
                        'parcel_id' => $invoice->parcel_id,
                        'invoice_id' => $invoice->id,
                        'supply_id' => $supply->id,
                    ]);
                }
            }
        }

        if($parcel->arrived_warehouse_id){
            $invoice->arrived_warehouse_id = $parcel->arrived_warehouse_id;
        }

        $invoice->total_qty = $qty;
        $invoice->customer_id = optional($invoice->pickupAddress)->user_id ?? null;
        $invoice->ship_customer_id = optional($invoice->deliveryAddress)->user_id ?? null;
        $invoice->save();



        // Create parcel history (if parcel was created or exists)
        if ($parcel) {
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => auth()->id(),
                'customer_id' => $invoice->customer_id ?? optional($invoice->pickupAddress)->user_id,
                'warehouse_id' => $invoice->warehouse_id,
                'status' => $status,
                'parcel_status' => 1,
                'description' => []
            ]);
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => auth()->id(),
                'customer_id' => $invoice->customer_id ?? optional($invoice->pickupAddress)->user_id,
                'warehouse_id' => $invoice->warehouse_id,
                'status' => $status,
                'parcel_status' => 3,
                'description' => []
            ]);
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => auth()->id(),
                'customer_id' => $invoice->customer_id ?? optional($invoice->pickupAddress)->user_id,
                'warehouse_id' => $invoice->warehouse_id,
                'status' => $status,
                'parcel_status' => 4,
                'description' => []
            ]);
        }

        return $parcel;
    }

}
