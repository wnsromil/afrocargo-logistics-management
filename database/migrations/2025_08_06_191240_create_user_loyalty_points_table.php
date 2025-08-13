<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLoyaltyPointsTable extends Migration
{
    public function up()
    {
        Schema::create('user_reward_points_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->enum('reward_type', ['Order-Based', 'Payment-Based'])->default(null)->nullable();;
            $table->unsignedBigInteger('order_id')->nullable();
            $table->decimal('reward_earned', 8, 2)->default(0.00);
            $table->decimal('reward_used', 8, 2)->default(0.00);
            $table->timestamp('expires_at')->nullable();
            $table->enum('status', ['earned', 'used', 'expired'])->default('earned');
            $table->timestamps();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_reward_points_history');
    }
}
