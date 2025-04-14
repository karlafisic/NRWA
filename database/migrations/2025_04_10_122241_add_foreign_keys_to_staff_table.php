<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->foreign(['address_id'], 'fk_staff_address')->references(['address_id'])->on('address')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['store_id'], 'fk_staff_store')->references(['store_id'])->on('store')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign('fk_staff_address');
            $table->dropForeign('fk_staff_store');
        });
    }
};
