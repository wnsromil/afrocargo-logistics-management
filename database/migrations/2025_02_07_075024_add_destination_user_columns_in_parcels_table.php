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
        Schema::table('parcels', function (Blueprint $table) {
            //
            $table->after('source_address',function()use($table){
                $table->string('destination_user_name')->nullable();
                $table->string('destination_user_phone')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            //
            $table->dropColumn('destination_user_name');
            $table->dropColumn('destination_user_phone');
        });
    }
};
