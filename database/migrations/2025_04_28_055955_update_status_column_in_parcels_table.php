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
        // Update 'parcels' table
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('status'); // Existing ENUM column ko drop karein
        });

        Schema::table('parcels', function (Blueprint $table) {
            $table->bigInteger('status')->default(1)->after('id'); // BIGINT column add karein
        });

        // Update 'parcel_histories' table
        Schema::table('parcel_histories', function (Blueprint $table) {
            $table->dropColumn('parcel_status'); // Existing ENUM column ko drop karein
        });

        Schema::table('parcel_histories', function (Blueprint $table) {
            $table->bigInteger('parcel_status')->default(1); // BIGINT column add karein
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes in 'parcels' table
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('status'); // BIGINT column ko drop karein
        });

        Schema::table('parcels', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_transit', 'delivered'])->default('pending'); // Original ENUM column recreate karein
        });

        // Revert changes in 'parcel_histories' table
        Schema::table('parcel_histories', function (Blueprint $table) {
            $table->dropColumn('parcel_status'); // BIGINT column ko drop karein
        });

        Schema::table('parcel_histories', function (Blueprint $table) {
            $table->enum('parcel_status', ['pending', 'in_transit', 'delivered'])->default('pending'); // Original ENUM column recreate karein
        });
    }
};