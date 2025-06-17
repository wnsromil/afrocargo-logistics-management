<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->integer('low_stock_warning')->nullable()->default(null)->change();
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->integer('low_stock_warning')->nullable(false)->default(0)->change(); // ya pehle jo default tha woh
        });
    }
};
