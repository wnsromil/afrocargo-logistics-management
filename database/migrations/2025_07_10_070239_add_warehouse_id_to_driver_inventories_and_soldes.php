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
        // Add warehouse_id to driver_inventories
        Schema::table('driver_inventories', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id')->nullable()->after('id');
        });

        // Add warehouse_id to driver_inventories_soldes
        Schema::table('driver_inventories_soldes', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove warehouse_id from driver_inventories
        Schema::table('driver_inventories', function (Blueprint $table) {
            $table->dropColumn('warehouse_id');
        });

        // Remove warehouse_id from driver_inventories_soldes
        Schema::table('driver_inventories_soldes', function (Blueprint $table) {
            $table->dropColumn('warehouse_id');
        });
    }
};
