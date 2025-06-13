<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->unsignedBigInteger('container_history_id')->nullable()->after('container_id');

            // Optional: Add foreign key constraint if needed
            // $table->foreign('container_history_id')->references('id')->on('container_histories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            // Drop column or foreign key if added
            // $table->dropForeign(['container_history_id']);
            $table->dropColumn('container_history_id');
        });
    }
};
