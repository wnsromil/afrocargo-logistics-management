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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(1)->after('id');

            // Agar tum chahte ho ki ye kisi users table se linked ho:
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Pehle foreign key drop karo agar banayi thi:
            // $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });
    }
};
