<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDimensionsAndRoleToParcelsTable extends Migration
{
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->decimal('length', 10, 2)->nullable()->after('driver_parcel_image');
            $table->decimal('width', 10, 2)->nullable()->after('length');
            $table->decimal('height', 10, 2)->nullable()->after('width');
            $table->string('update_role')->nullable()->after('height');
        });
    }

    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn(['length', 'width', 'height', 'update_role']);
        });
    }
}

