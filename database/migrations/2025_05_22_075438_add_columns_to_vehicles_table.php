<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('container_company_id')->nullable()->after('id');
            $table->string('ship_to_country')->nullable();
            $table->string('broker')->nullable();
            $table->string('doc_id')->nullable();
            $table->decimal('volume', 8, 2)->nullable();
        });
    }

    public function down(): void {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'container_company_id',
                'ship_to_country',
                'broker',
                'doc_id',
                'volume',
            ]);
        });
    }
};
