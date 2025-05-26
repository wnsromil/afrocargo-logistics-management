<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('vehicle_registration_doc')->nullable()->after('vehicle_number');
            $table->string('vehicle_insurance_doc')->nullable()->after('vehicle_registration_doc');
            $table->string('licence_plate_number')->nullable()->after('vehicle_insurance_doc');
            $table->date('licence_plate_exp_date')->nullable()->after('licence_plate_number');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'vehicle_registration_doc',
                'vehicle_insurance_doc',
                'licence_plate_number',
                'licence_plate_exp_date',
            ]);
        });
    }
};
