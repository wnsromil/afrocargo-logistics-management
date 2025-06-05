<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultContainerSizesTable extends Migration
{
    public function up()
    {
        Schema::create('default_container_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('update_user_id')->nullable();
            $table->string('container_name');
            $table->string('dimensions')->default('cm'); // cm, feet, etc.
            $table->float('length');
            $table->float('breadth');
            $table->float('height');
            $table->float('volume');
            $table->float('tare_weight');
            $table->float('max_weight');
            $table->timestamps();
        });

        // Insert default data
        DB::table('default_container_sizes')->insert([
            [
                'container_name' => 'Standard 20 Feet',
                'dimensions' => 'cm',
                'length' => 590,
                'breadth' => 235,
                'height' => 239,
                'volume' => 33.2000,
                'tare_weight' => 2230.00,
                'max_weight' => 21770.00,
            ],
            [
                'container_name' => 'Standard 40 Feet',
                'dimensions' => 'cm',
                'length' => 1203,
                'breadth' => 235,
                'height' => 239,
                'volume' => 67.7000,
                'tare_weight' => 3700.00,
                'max_weight' => 26780.00,
            ],
            [
                'container_name' => 'High Cube 40 Feet',
                'dimensions' => 'cm',
                'length' => 1204,
                'breadth' => 235,
                'height' => 269,
                'volume' => 76.3000,
                'tare_weight' => 3970.00,
                'max_weight' => 26510.00,
            ],
            [
                'container_name' => 'Upgraded 20 Feet',
                'dimensions' => 'cm',
                'length' => 590,
                'breadth' => 231,
                'height' => 239,
                'volume' => 32.6300,
                'tare_weight' => 2300.00,
                'max_weight' => 28180.00,
            ],
            [
                'container_name' => 'Reefer 20 Feet',
                'dimensions' => 'cm',
                'length' => 542,
                'breadth' => 227,
                'height' => 226,
                'volume' => 28.3000,
                'tare_weight' => 3200.00,
                'max_weight' => 20800.00,
            ],
            [
                'container_name' => 'Reefer 40 Feet',
                'dimensions' => 'cm',
                'length' => 1149,
                'breadth' => 227,
                'height' => 219,
                'volume' => 57.8000,
                'tare_weight' => 4900.00,
                'max_weight' => 25580.00,
            ],
            [
                'container_name' => 'Reefer 40 Feet High Cube',
                'dimensions' => 'cm',
                'length' => 1155,
                'breadth' => 229,
                'height' => 250,
                'volume' => 66.6000,
                'tare_weight' => 4500.00,
                'max_weight' => 25980.00,
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('default_container_sizes');
    }
}
