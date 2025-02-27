<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverParcelImageToParcelsTable extends Migration
{
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->string('driver_parcel_image')->nullable()->after('driver_subcategories_data');
        });
    }

    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('driver_parcel_image');
        });
    }
}
