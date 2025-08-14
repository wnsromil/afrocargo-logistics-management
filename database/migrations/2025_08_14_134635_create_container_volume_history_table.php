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
        Schema::create('container_volume_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('container_id');
            $table->unsignedBigInteger('parcel_id')->nullable();
            $table->unsignedBigInteger('inventory_id')->nullable();
            $table->decimal('volume', 15, 2);
            $table->timestamps();

            // Agar foreign key relation chahiye to uncomment karo:
            // $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            // $table->foreign('parcel_id')->references('id')->on('parcels')->onDelete('set null');
            // $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_volume_history');
    }
};
