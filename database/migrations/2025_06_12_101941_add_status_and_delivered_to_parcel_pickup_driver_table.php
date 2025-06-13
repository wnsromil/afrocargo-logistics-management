<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('parcel_pickup_driver', function (Blueprint $table) {
            $table->string('status')->nullable()->after('driver_id');
            $table->enum('delivered', ['Yes', 'No'])->default('No')->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('parcel_pickup_driver', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('delivered');
        });
    }
};
