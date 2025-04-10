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
            $table->enum('add_order', ['admin', 'warehouse_manger', 'driver', 'self'])
                  ->default('self')
                  ->after('id'); // ya jis column ke baad chahiye ho
        });
    }
    
    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('add_order');
        });
    }
    
};
