<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('parcels', function (Blueprint $table) {
            $table->date('pickup_date')->nullable()->format('d-m-Y');
            $table->date('delivery_date')->nullable()->format('d-m-Y');
        });
    }

    public function down() {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn(['pickup_date', 'delivery_date']);
        });
    }
};
