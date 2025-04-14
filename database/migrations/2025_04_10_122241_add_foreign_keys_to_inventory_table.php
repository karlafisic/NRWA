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
        Schema::table('inventory', function (Blueprint $table) {
            $table->foreign(['film_id'], 'fk_inventory_film')->references(['film_id'])->on('film')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['store_id'], 'fk_inventory_store')->references(['store_id'])->on('store')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropForeign('fk_inventory_film');
            $table->dropForeign('fk_inventory_store');
        });
    }
};
