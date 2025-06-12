<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('container_history', function (Blueprint $table) {
            $table->date('open_date')->nullable()->after('driver_id');
            $table->date('close_date')->nullable()->after('open_date');
        });
    }

    public function down(): void
    {
        Schema::table('container_history', function (Blueprint $table) {
            $table->dropColumn('open_date');
            $table->dropColumn('close_date');
        });
    }
};

