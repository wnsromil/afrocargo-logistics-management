<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToVehiclesAndParcelsTables extends Migration
{
    public function up()
    {
        // Vehicles table changes
        Schema::table('vehicles', function (Blueprint $table) {
            $table->date('transfer_date')->nullable()->after('status');
            $table->bigInteger('container_status')->nullable()->after('transfer_date');
            $table->string('note')->nullable()->after('container_status');
            $table->bigInteger('arrived_warehouse_id')->nullable()->after('note');
        });

        // Parcels table changes
        Schema::table('parcels', function (Blueprint $table) {
            $table->bigInteger('arrived_warehouse_id')->nullable()->after('container_id');
            $table->bigInteger('arrived_driver_id')->nullable()->after('arrived_warehouse_id');
        });
    }

    public function down()
    {
        // Rollback for vehicles
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['transfer_date', 'container_status', 'note', 'arrived_warehouse_id']);
        });

        // Rollback for parcels
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn(['arrived_warehouse_id', 'arrived_driver_id']);
        });
    }
}
