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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('seal_no')->nullable(); // Ya required ho to nullable hata do
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('seal_no');
        });
    }
};
