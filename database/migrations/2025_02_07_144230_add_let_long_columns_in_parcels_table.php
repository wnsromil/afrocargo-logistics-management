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
            ])->default('Pending')->change();

            $table->after('amount',function()use($table){
                $table->string('source_let')->nullable();
                $table->string('source_long')->nullable();
                $table->string('dest_let')->nullable();
                $table->string('dest_long')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            //
            $table->dropColumn('source_let');
            $table->dropColumn('source_long');
            $table->dropColumn('dest_let');
            $table->dropColumn('dest_let');
        });
    }
};
