<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_pickup_details', function (Blueprint $table) {
            $table->string('pickup_status_type')->nullable()->after('pickup_type'); // pickup_status ke baad add hoga
        });
    }

    public function down()
    {
        Schema::table('user_pickup_details', function (Blueprint $table) {
            $table->dropColumn('pickup_status_type');
        });
    }
};
