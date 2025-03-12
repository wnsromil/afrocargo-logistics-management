<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('full_name')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'warehouse_id']);
        });
    }
};
