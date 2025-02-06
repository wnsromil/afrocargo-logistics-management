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
        Schema::table('parcels', function (Blueprint $table) {
            //
            $table->enum('status', [
                'pending',
            'Pickup Assign',
            'Pickup Re-Schedule',
            'Received By Pickup Man',
            'Received Warehouse',
            'Transfer to hub',
            'Received by hub',
            'Delivery Man Assign',
            'Return to Courier',
            'Delivered',
            ])->default('pending')->change();
        });
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
