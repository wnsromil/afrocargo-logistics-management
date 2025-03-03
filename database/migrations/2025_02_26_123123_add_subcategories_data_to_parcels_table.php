<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->json('customer_subcategories_data')->nullable()->after('parcel_car_ids'); 
            $table->json('driver_subcategories_data')->nullable()->after('customer_subcategories_data'); 
        });
    }

    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('customer_subcategories_data');
            $table->dropColumn('driver_subcategories_data');
        });
    }
};
