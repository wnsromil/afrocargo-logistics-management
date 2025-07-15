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
            $table->string('unique_id')->nullable()->after('id'); // after 'id' or adjust as needed
            $table->string('apartment')->nullable()->after('address');
            $table->enum('is_deleted', ['Yes', 'No'])->default('No')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('unique_id');
            $table->dropColumn('apartment');
            $table->dropColumn('is_deleted');
        });
    }
};
