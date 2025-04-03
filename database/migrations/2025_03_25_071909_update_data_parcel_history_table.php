<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $parcels = DB::table('parcel_histories')->get();

        foreach ($parcels as $parcel) {
            if (!empty($parcel->description)) {
                $json = $parcel->description;

                // Check if JSON is double encoded
                if (is_string($json)) {
                    $decoded = json_decode($json, true);
                    if (is_string($decoded)) {
                        $decoded = json_decode($decoded, true);
                    }
                    if (!empty($decoded['customer_subcategories_data']) && is_string($decoded['customer_subcategories_data'])) {
                        $decoded['customer_subcategories_data'] = json_decode($decoded['customer_subcategories_data'], true);
                    }
                    if (!empty($decoded['driver_subcategories_data']) && is_string($decoded['driver_subcategories_data'])) {
                        $decoded['driver_subcategories_data'] = json_decode($decoded['driver_subcategories_data'], true);
                    }

                    // Save valid JSON back to database
                    DB::table('parcel_histories')
                        ->where('id', $parcel->id)
                        ->update(['description' => json_encode($decoded)]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcel_histories', function (Blueprint $table) {
            //
        });
    }
};
