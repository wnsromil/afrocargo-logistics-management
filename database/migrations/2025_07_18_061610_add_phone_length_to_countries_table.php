<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('countries', function (Blueprint $table) {
        $table->unsignedTinyInteger('phone_length')->nullable()->after('phonecode');
    });
}

public function down()
{
    Schema::table('countries', function (Blueprint $table) {
        $table->dropColumn('phone_length');
    });
}
};
