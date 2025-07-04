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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('country');                // e.g., "India"
            $table->string('currency_name');          // e.g., "Indian Rupee"
            $table->string('currency_code', 3);       // e.g., "INR"
            $table->decimal('exchange_rate', 12, 4);  // e.g., 83.1000 (USD to INR)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
