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
        // Step 1: Change enum to string temporarily
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->change();
        });

        // Step 2: Change string back to enum with updated values
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'warehouse_manager',
                'customer',
                'driver',
                'ship_to_customer',
                'pickup_to_customer',
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Change enum to string again
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->change();
        });

        // Step 2: Revert enum to old values
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'warehouse_manager',
                'customer',
                'driver',
                'ship_to_customer',
            ])->change();
        });
    }
};
