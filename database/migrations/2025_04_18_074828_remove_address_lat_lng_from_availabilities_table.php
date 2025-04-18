<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAddressLatLngFromAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->dropColumn(['address', 'lat', 'lng']);
        });
    }

    public function down()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
        });
    }
}
