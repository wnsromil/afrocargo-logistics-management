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
        Schema::table('parcels', function (Blueprint $table) {
            $table->string('source_address')->nullable()->change();
            $table->string('destination_address')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->string('source_address')->nullable(false)->change();
            $table->string('destination_address')->nullable(false)->change();
        });
    }
};
