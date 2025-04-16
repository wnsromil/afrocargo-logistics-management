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
            $table->enum('payment_status', ['Completed', 'Partial', 'Paid', 'Unpaid'])->default('Unpaid')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original values
        Schema::table('parcels', function (Blueprint $table) {
            $table->enum('payment_status', ['Completed', 'Partial'])->default('Completed')->change();
        });
    }
};
