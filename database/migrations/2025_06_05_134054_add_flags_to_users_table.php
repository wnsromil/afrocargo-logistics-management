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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('contract', ['Yes', 'No'])->default('No');
            $table->enum('text_cust', ['Yes', 'No'])->default('No');
            $table->enum('voice_call', ['Yes', 'No'])->default('No');
            $table->enum('cash_cust', ['Yes', 'No'])->default('No');
            $table->enum('is_license_pic', ['Yes', 'No'])->default('No');
            $table->enum('no_service', ['Yes', 'No'])->default('No');
            $table->enum('call', ['Yes', 'No'])->default('No');
            $table->enum('sales_call', ['Yes', 'No'])->default('No');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'contract',
                'text_cust',
                'voice_call',
                'cash_cust',
                'is_license_pic',
                'no_service',
                'call',
                'sales_call',
            ]);
        });
    }
};
