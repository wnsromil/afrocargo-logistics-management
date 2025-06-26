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
        Schema::table('addresses', function (Blueprint $table) {
            $table->enum('type', ['Services', 'Supply', 'Air', 'Ocean'])->default('Services')->after('id');
            $table->enum('default_address', ['Yes', 'No'])->default('No')->after('type');
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('default_address');
        });
    }
};
