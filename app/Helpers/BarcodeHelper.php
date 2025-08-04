<?php

use Milon\Barcode\DNS1D;
use App\Models\Barcode;

if (!function_exists('generate_barcode_number')) {
    /**
     * Generate a unique barcode number
     *
     * @return string
     */
    function generate_barcode_number()
    {
        do {
            $barcode = '06' . mt_rand(100000000, 999999999);
        } while (Barcode::where('barcode', $barcode)->exists());

        return $barcode;
    }
}

if (!function_exists('generate_barcode_image')) {
    /**
     * Generate barcode image HTML
     *
     * @param string $barcodeNumber
     * @param string $type
     * @param int $widthFactor
     * @param int $height
     * @return string
     */
    function generate_barcode_image($barcodeNumber, $type = 'C128', $widthFactor = 2, $height = 50,$barColor = false)
    {
        $generator = new DNS1D();
        if($barColor){
            $generator->setColor($barColor);
        }
        return $generator->getBarcodeHTML($barcodeNumber, $type, $widthFactor, $height);
    }
}

if (!function_exists('store_barcode')) {
    /**
     * Store barcode in database
     *
     * @param array $data
     * @return array
     */
    function store_barcode($data)
    {
        $barcodeNumber = $data['barcode'] ?? generate_barcode_number();
        // Barcode::where(['supply_id' => $data['supply_id']])->delete();
        $barcode = Barcode::create([
            'invoice_id' => $data['invoice_id'] ?? null,
            'parcel_id' => $data['parcel_id'] ?? null,
            'supply_id' => $data['supply_id'] ?? null,
            'barcode' => generate_barcode_image($barcodeNumber),
            'barcode_code' => $barcodeNumber,
            'description' => $data['description'] ?? null,
            'type' => $data['type'] ?? 'C128',
            'created_by_id' => auth()->id() ?? null
        ]);

        return $barcode;

        // return [
        //     'model' => $barcode,
        //     'image' => generate_barcode_image($barcodeNumber, $data['type'] ?? 'C128'),
        //     'number' => $barcodeNumber
        // ];
    }
}

if (!function_exists('generate_and_store_barcode')) {
    /**
     * Generate and store barcode (all-in-one function)
     *
     * @param array $data
     * @return array
     */
    function generate_and_store_barcode($data)
    {
        return store_barcode($data);
    }
}
