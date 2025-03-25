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
    
        $parcels = DB::table('parcels')->get();

        foreach ($parcels as $parcel) {
            if (!empty($parcel->customer_subcategories_data)) {
                $json = $parcel->customer_subcategories_data;

                // Check if JSON is double encoded
                if (is_string($json)) {
                    $decoded = json_decode($json, true);
                    if (is_string($decoded)) {
                        $decoded = json_decode($decoded, true);
                    }

                    // Save valid JSON back to database
                    DB::table('parcels')
                        ->where('id', $parcel->id)
                        ->update(['customer_subcategories_data' => json_encode($decoded)]);
                }
            }

            if (!empty($parcel->driver_subcategories_data)) {
                $json = $parcel->driver_subcategories_data;

                // Check if JSON is double encoded
                if (is_string($json)) {
                    $decoded = json_decode($json, true);
                    if (is_string($decoded)) {
                        $decoded = json_decode($decoded, true);
                    }

                    // Save valid JSON back to database
                    DB::table('parcels')
                        ->where('id', $parcel->id)
                        ->update(['driver_subcategories_data' => json_encode($decoded)]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            //
        });
    }
};
