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
        Schema::table('user_pickup_details', function (Blueprint $table) {
            $table->string('pickup_type')->nullable()->after('pickup_delivery');
            
        });
    }

    public function down(): void
    {
        Schema::table('user_pickup_details', function (Blueprint $table) {
            $table->dropColumn('pickup_type');
        });
    }
};
