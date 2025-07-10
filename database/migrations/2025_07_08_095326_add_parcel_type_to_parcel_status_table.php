<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
   public function up()
    {
        Schema::table('parcel_status', function (Blueprint $table) {
            $table->enum('parcel_type', ['Service', 'Supply', 'Comman'])->default('Service')->after('id');
        });

        // Update specific IDs to 'Comman'
        DB::table('parcel_status')
            ->whereIn('id', [1, 9, 10, 11, 12, 13, 14, 23])
            ->update(['parcel_type' => 'Comman']);

        // Update all others to 'Service'
        DB::table('parcel_status')
            ->whereNotIn('id', [1, 9, 10, 11, 12, 13, 14, 23])
            ->update(['parcel_type' => 'Service']);
    }

    public function down()
    {
        Schema::table('parcel_status', function (Blueprint $table) {
            $table->dropColumn('parcel_type');
        });
    }
};
