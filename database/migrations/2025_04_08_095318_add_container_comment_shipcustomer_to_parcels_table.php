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
            $table->unsignedBigInteger('container_id')->nullable()->after('add_order');
            $table->text('percel_comment')->nullable()->after('container_id');
            $table->unsignedBigInteger('ship_customer_id')->nullable()->after('customer_id');
        });
    }

    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn(['container_id', 'percel_comment', 'ship_customer_id']);
        });
    }
};
