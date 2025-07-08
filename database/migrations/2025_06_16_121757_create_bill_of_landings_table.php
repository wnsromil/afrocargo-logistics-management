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
        Schema::create('bill_of_landings', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('type')->nullable(); // e.g., Shipper, Consignee
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('cellphone_code')->nullable();
            $table->string('carrier')->nullable();
            $table->timestamps();
        });

        // \DB::statement("ALTER TABLE `individual_payments` ADD `currency` VARCHAR(20) NULL DEFAULT 'USD' AFTER `id`");
        \DB::statement("ALTER TABLE `individual_payments` CHANGE `currency` `local_currency` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_of_landings');
    }
};
