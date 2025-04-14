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
        Schema::table('rental', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'fk_rental_customer')->references(['customer_id'])->on('customer')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['inventory_id'], 'fk_rental_inventory')->references(['inventory_id'])->on('inventory')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['staff_id'], 'fk_rental_staff')->references(['staff_id'])->on('staff')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental', function (Blueprint $table) {
            $table->dropForeign('fk_rental_customer');
            $table->dropForeign('fk_rental_inventory');
            $table->dropForeign('fk_rental_staff');
        });
    }
};
