<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firebase_token')->nullable()->after('notification_read');
            $table->enum('device_type', ['Android', 'Ios', 'Web'])->nullable()->after('firebase_token');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['firebase_token', 'device_type']);
        });
    }
};
