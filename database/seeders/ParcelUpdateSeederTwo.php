<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParcelUpdateSeederTwo extends Seeder
{
    public function run()
    {
        // First 5 rows ko select karna
        $parcels = DB::table('parcels')->orderBy('id')->limit(5)->get();

        // Multiple categories store karne ke liye JSON array
        $updatedData = [
            [
                'driver_subcategories_data' => json_encode([
                    [
                        "category_id" => 1,
                        "subcategories" => [
                            ["id" => 1, "name" => "Small Box", "quantity" => 10, "value" => 20],
                            ["id" => 2, "name" => "Medium Box", "quantity" => 5, "value" => 15]
                        ]
                    ],
                    [
                        "category_id" => 2,
                        "subcategories" => [
                            ["id" => 5, "name" => "Glass Bottle", "quantity" => 12, "value" => 50],
                            ["id" => 6, "name" => "Plastic Bottle", "quantity" => 15, "value" => 35]
                        ]
                    ]
                ]),
            ],
            [
                'driver_subcategories_data' => json_encode([
                    [
                        "category_id" => 3,
                        "subcategories" => [
                            ["id" => 7, "name" => "Hand Bag", "quantity" => 8, "value" => 40],
                            ["id" => 8, "name" => "Travel Bag", "quantity" => 6, "value" => 60]
                        ]
                    ],
                    [
                        "category_id" => 1,
                        "subcategories" => [
                            ["id" => 3, "name" => "Large Box", "quantity" => 7, "value" => 30],
                            ["id" => 4, "name" => "Custom Box", "quantity" => 3, "value" => 25]
                        ]
                    ]
                ]),
            ]
        ];

        // Loop through first 5 parcels and update them
        $index = 0;
        foreach ($parcels as $parcel) {
            DB::table('parcels')->where('id', $parcel->id)->update([
                'driver_subcategories_data' => $updatedData[$index]['driver_subcategories_data'],
                'updated_at' => Carbon::now(),
            ]);

            echo "✅ Parcel ID {$parcel->id} updated successfully!\n";
            $index++;
        }

        echo "✅ ParcelUpdateSeederTwo executed successfully!\n";
    }
}
