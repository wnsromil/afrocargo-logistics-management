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
            $table->bigInteger('invoice_id')->after('container_id')->nullable();
        });
        Schema::table('invoices', function (Blueprint $table) {
            //
            $table->bigInteger('arrived_warehouse_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            //
            $table->dropColumn('invoice_id');
        });
        Schema::table('invoices', function (Blueprint $table) {
            //
            $table->dropColumn('arrived_warehouse_id');
        });
    }
};
