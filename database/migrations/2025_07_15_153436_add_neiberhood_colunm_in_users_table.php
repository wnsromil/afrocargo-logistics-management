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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('neighborhood')->after('address')->nullable()->default(null);
        });
        Schema::table('addresses', function (Blueprint $table) {
            //
            $table->string('neighborhood')->after('address')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('neighborhood');
        });
        Schema::table('addresses', function (Blueprint $table) {
            //
            $table->dropColumn('neighborhood');
        });
    }
};
