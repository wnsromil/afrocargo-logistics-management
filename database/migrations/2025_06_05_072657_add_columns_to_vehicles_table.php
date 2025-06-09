<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // ड्राइवर आईडी—अगर drivers टेबल है तो unsignedBigInteger रखें
            $table->unsignedBigInteger('gate_in_driver_id')->nullable()->after('tir_number');
            $table->unsignedBigInteger('gate_out_driver_id')->nullable()->after('gate_in_driver_id');

            // पोर्ट वगैरह
            $table->string('port_of_loading')->nullable()->after('gate_out_driver_id');
            $table->string('port_of_discharge')->nullable()->after('port_of_loading');

            // दिनांक (FORMAT: YYYY-MM-DD)  
            $table->date('celliling_date')->nullable()->after('port_of_discharge');
            $table->date('eta_date')->nullable()->after('celliling_date');

            // ट्रान्ज़िट कंट्री
            $table->string('transit_country')->nullable()->after('eta_date');

            /*  
            // (Optional) अगर foreign key लगानी हो:
            // $table->foreign('gate_in_driver_id')->references('id')->on('drivers')->nullOnDelete();
            // $table->foreign('gate_out_driver_id')->references('id')->on('drivers')->nullOnDelete();
            */
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'gate_in_driver_id',
                'gate_out_driver_id',
                'port_of_loading',
                'port_of_discharge',
                'celliling_date',
                'eta_date',
                'transit_country',
            ]);
        });
    }
};
