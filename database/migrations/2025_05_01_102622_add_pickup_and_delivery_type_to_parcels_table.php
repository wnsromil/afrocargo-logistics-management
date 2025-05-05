<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->enum('pickup_type', ['self', 'driver'])->nullable()->after('pickup_time'); // ya kisi existing column ke baad
            $table->enum('delivery_type', ['self', 'driver'])->nullable()->after('pickup_type');
        });
    }
    
    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn(['pickup_type', 'delivery_type']);
        });
    }
    
};
