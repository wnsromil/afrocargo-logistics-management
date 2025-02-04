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
        // Schema::table('users', function (Blueprint $table) {
        //     $table->unsignedBigInteger('warehouse_id')->nullable()->after('id');
        //     // $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null');

        //     $table->unsignedBigInteger('vehicle_id')->nullable()->after('id');
        //     // $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
        // });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn(['warehouse_id','vehicle_id']);
        });
    }

};
