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
    Schema::table('parcels', function (Blueprint $table) {
        $table->enum('transport_type', ['Air Cargo', 'Ocean Cargo', 'null'])->default('null')->after('id');
    });
}

public function down()
{
    Schema::table('parcels', function (Blueprint $table) {
        $table->dropColumn('transport_type');
    });
}

};
