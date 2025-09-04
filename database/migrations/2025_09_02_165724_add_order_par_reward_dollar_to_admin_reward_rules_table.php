<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin_reward_rules', function (Blueprint $table) {
            $table->decimal('order_par_reward_dollar', 10, 2)->nullable()->after('order_min');
        });
    }

    public function down(): void
    {
        Schema::table('admin_reward_rules', function (Blueprint $table) {
            $table->dropColumn('order_par_reward_dollar');
        });
    }
};
