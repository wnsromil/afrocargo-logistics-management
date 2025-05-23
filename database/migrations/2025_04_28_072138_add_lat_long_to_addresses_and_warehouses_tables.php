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
        // Add 'lat' and 'long' columns to 'addresses' table
        Schema::table('addresses', function (Blueprint $table) {
            $table->decimal('lat', 10, 8)->nullable(); // Latitude column
            $table->decimal('long', 11, 8)->nullable(); // Longitude column
        });

        // Add 'lat' and 'long' columns to 'warehouses' table
        Schema::table('warehouses', function (Blueprint $table) {
            $table->decimal('lat', 10, 8)->nullable(); // Latitude column
            $table->decimal('long', 11, 8)->nullable(); // Longitude column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'lat' and 'long' columns from 'addresses' table
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn(['lat', 'long']);
        });

        // Remove 'lat' and 'long' columns from 'warehouses' table
        Schema::table('warehouses', function (Blueprint $table) {
            $table->dropColumn(['lat', 'long']);
        });
    }
};