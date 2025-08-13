<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLoyaltyRulesTable extends Migration
{
    public function up()
    {
        Schema::create('admin_reward_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->decimal('order_par_min_amount', 10, 2)->default(0.00);
            $table->integer('order_min')->default(0);
            $table->decimal('amount_min_total_invoice', 8, 2)->default(0.00);
            $table->decimal('reward_dollar', 8, 2)->default(0.00);
            $table->integer('expires_in_days')->default(0)->comment('Number of days after which points expire')->nullable();
            $table->enum('status', ['Inactive', 'Active'])->default('Active')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_reward_rules');
    }
}
