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
        Schema::table('addresses', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('mobile_number_code_id')->nullable()->after('mobile_number');
            $table->unsignedBigInteger('alternative_mobile_number_code_id')->nullable()->after('alternative_mobile_number');
        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('phone_code_id')->nullable()->after('phone');
            $table->unsignedBigInteger('phone_2_code_id_id')->nullable()->after('phone_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
            $table->dropColumn([
                'mobile_number_code_id',
                'alternative_mobile_number_code_id'
            ]);
        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'phone_2_code_id',
                'phone_code_id'
            ]);
        });
    }
};
