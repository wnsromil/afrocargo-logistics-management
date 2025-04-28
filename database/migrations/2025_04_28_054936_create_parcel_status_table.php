<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // DB facade ko import karein

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table create karna
        Schema::create('parcel_status', function (Blueprint $table) {
            $table->id(); // Primary key column
            $table->string('status'); // Column for status
            $table->timestamps(); // Created_at and updated_at columns
        });

        // Default status values insert karna
        $statuses = [
            'Pending',
            'Pick up with driver',
            'Arrived at warehouse',
            'In transit',
            'Full load',
            'Full discharge',
            'Arrived at final destination warehouse',
            'Ready for pick up',
            'Out for delivery',
            'Delivered',
            'Re-delivery',
            'Picked up',
            'On hold',
            'Cancelled',
            'Abandoned',
        ];

        foreach ($statuses as $status) {
            DB::table('parcel_status')->insert([
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Table drop karna
        Schema::dropIfExists('parcel_status');
    }
};