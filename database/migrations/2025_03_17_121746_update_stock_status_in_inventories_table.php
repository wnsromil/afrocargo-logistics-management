<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            \DB::statement("ALTER TABLE inventories MODIFY COLUMN stock_status ENUM('In Stock', 'Out of Stock', 'Low Stock') NOT NULL");
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            \DB::statement("ALTER TABLE inventories MODIFY COLUMN stock_status ENUM('In Stock', 'Out of Stock') NOT NULL");
        });
    }
};
