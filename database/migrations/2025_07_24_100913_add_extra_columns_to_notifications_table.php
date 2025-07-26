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
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('role')->nullable()->after('type');
            $table->unsignedBigInteger('warehouse_id')->nullable()->after('role');
            $table->unsignedBigInteger('container_id')->nullable()->after('warehouse_id');
            $table->unsignedBigInteger('eod_id')->nullable()->after('container_id');
            $table->unsignedBigInteger('invoice_id')->nullable()->after('eod_id');
            $table->unsignedBigInteger('bill_id')->nullable()->after('invoice_id');
            $table->string('unique_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'warehouse_id',
                'container_id',
                'eod_id',
                'invoice_id',
                'bill_id',
            ]);
        });
    }
};
