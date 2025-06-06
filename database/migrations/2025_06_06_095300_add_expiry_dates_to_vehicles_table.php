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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->date('vehicle_registration_exp_date')->nullable()->after('vehicle_registration_doc');
            $table->date('vehicle_insurance_exp_date')->nullable()->after('vehicle_insurance_doc');
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('vehicle_registration_exp_date');
            $table->dropColumn('vehicle_insurance_exp_date');
        });
    }
};
