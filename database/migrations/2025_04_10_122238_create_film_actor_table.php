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
        Schema::create('film_actor', function (Blueprint $table) {
            $table->unsignedSmallInteger('actor_id');
            $table->unsignedSmallInteger('film_id')->index('idx_fk_film_id');
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['actor_id', 'film_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_actor');
    }
};
