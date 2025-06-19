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
        Schema::table('bill_of_landings', function (Blueprint $table) {
            //
            $table->string('unique_id')->nullable()->after('id'); // Adding unqui_id column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_of_landings', function (Blueprint $table) {
            //
            $table->dropColumn('unique_id'); // Dropping unqui_id column
        });
    }
};
