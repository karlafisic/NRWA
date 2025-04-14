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
        Schema::create('inventory', function (Blueprint $table) {
            $table->mediumIncrements('inventory_id');
            $table->unsignedSmallInteger('film_id')->index('idx_fk_film_id');
            $table->unsignedTinyInteger('store_id');
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();

            $table->index(['store_id', 'film_id'], 'idx_store_id_film_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
