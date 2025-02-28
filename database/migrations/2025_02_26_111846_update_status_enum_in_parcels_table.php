<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateStatusEnumInParcelsTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE parcels MODIFY COLUMN status ENUM(
            'Pending','Pickup Assign','Pickup Re-Schedule','Received By Pickup Man',
            'Received Warehouse','Transfer to hub','Received by hub','Delivery Man Assign',
            'Return to Courier','Delivered','Return to Warehouse','Return to Pickup Man',
            'Return to Hub','Cancelled','On the Way'
        ) NOT NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE parcels MODIFY COLUMN status ENUM(
            'Pending','Pickup Assign','Pickup Re-Schedule','Received By Pickup Man',
            'Received Warehouse','Transfer to hub','Received by hub','Delivery Man Assign',
            'Return to Courier','Delivered','Return to Warehouse','Return to Pickup Man',
            'Return to Hub','Cancelled'
        ) NOT NULL");
    }
}
