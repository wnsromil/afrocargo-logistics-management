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
        Schema::table('parcel_signature_pickup', function (Blueprint $table) {
            $table->string('currency_name')->nullable(); // currency name field add kiya
        });
    }

    public function down()
    {
        Schema::table('parcel_signature_pickup', function (Blueprint $table) {
            $table->dropColumn('currency_name'); // agar rollback karna ho to
        });
    }

    
};
