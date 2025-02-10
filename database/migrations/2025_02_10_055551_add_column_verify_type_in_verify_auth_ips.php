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
        Schema::table('verify_auth_ips', function (Blueprint $table) {
            //
            $table->string('verify_type')->nullable()->defualt('auth')->after('otp_varify_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verify_auth_ips', function (Blueprint $table) {
            //
            $table->dropColumn('verify_type');
        });
    }
};
