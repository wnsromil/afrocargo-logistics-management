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
        Schema::table('parcel_inventories', function (Blueprint $table) {
            $table->unsignedBigInteger('container_id')->nullable()->after('id');
            $table->unsignedBigInteger('container_move_id')->nullable()->after('container_id');
            $table->enum('move', ['Yes', 'No'])->default('No')->after('container_move_id');
            $table->string('img')->nullable()->after('move');
            $table->enum('is_deleted', ['Yes', 'No'])->default('No')->after('img');
            $table->unsignedBigInteger('driver_id')->nullable()->after('is_deleted');
            $table->string('status')->nullable()->after('driver_id');
            $table->string('quantity_type')->nullable()->after('status');
            $table->enum('delivered', ['Yes', 'No'])->default('No')->after('quantity_type');
        });
    }

    public function down(): void
    {
        Schema::table('parcel_inventories', function (Blueprint $table) {
            $table->dropColumn([
                'container_id',
                'container_move_id',
                'move',
                'img',
                'is_deleted',
                'driver_id',
                'status',
                'delivered',
                'quantity_type'
            ]);
        });
    }
};
