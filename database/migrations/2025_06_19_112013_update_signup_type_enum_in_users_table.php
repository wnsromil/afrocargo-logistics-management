<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("ALTER TABLE users MODIFY signup_type ENUM('self', 'for_admin', 'for_driver', 'for_customer') DEFAULT 'self'");
    }

    public function down()
    {
        // rollback old enum (without for_customer)
        DB::statement("ALTER TABLE users MODIFY signup_type ENUM('self', 'for_admin', 'for_driver') DEFAULT 'self'");
    }
};
