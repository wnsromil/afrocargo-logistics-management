<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCountryStateCityColumnsInAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('country_id')->change();
            $table->string('state_id')->change();
            $table->string('city_id')->change();
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->integer('country_id')->change();
            $table->integer('state_id')->change();
            $table->integer('city_id')->change();
        });
    }
}
