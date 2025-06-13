<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('parcel_pickup_driver', function (Blueprint $table) {
            $table->unsignedBigInteger('container_id')->nullable()->after('id');
            $table->unsignedBigInteger('container_move_id')->nullable()->after('container_id');
            $table->enum('move', ['Yes', 'No'])->default('No')->after('container_move_id');
        });
    }

    public function down(): void
    {
        Schema::table('parcel_pickup_driver', function (Blueprint $table) {
            $table->dropColumn(['container_id', 'container_move_id', 'move']);
        });
    }
};
