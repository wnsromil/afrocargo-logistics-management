<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hub_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('vehicle_id')->nullable();
            $table->integer('to_warehouse_id')->nullable();
            $table->integer('from_warehouse_id')->nullable();
            $table->datetime('tracking_start_at')->nullable();
            $table->enum('status', [
                'Pending',
            'Pickup Assign',
            'Pickup Re-Schedule',
            'Received By Pickup Man',
            'Received Warehouse',
            'Transfer to hub',
            'Received by hub',
            'Delivery Man Assign',
            'Return to Courier',
            'Delivered',
            'Return to Warehouse',
            'Return to Pickup Man',
            'Return to Hub',
            'Cancelled'
            ])->default('Pending');
            $table->timestamps();
        });

        Schema::table('parcels', function (Blueprint $table) {
            //
            $table->after('id',function()use($table){
                $table->unsignedBigInteger('hub_tracking_id')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hub_trackings');
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('hub_tracking_id');
        });
    }
};
