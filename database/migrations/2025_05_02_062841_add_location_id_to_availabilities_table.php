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
        Schema::table('availabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable()->after('id'); // 'id' ke baad ya jis column ke baad chahte hain
        });
    }
    
    public function down()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->dropColumn('location_id');
        });
    }
    
};
