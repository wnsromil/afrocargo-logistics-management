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
        Schema::create('verify_auth_ips', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullabe();
            $table->string('ip_address')->nullabe();
            $table->string('otp')->nullable();
            $table->datetime('otp_varify_at')->nullable();
            $table->datetime('otp_expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_auth_ips');
    }
};
