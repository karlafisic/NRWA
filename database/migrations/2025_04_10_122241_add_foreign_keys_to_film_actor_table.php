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
        Schema::table('film_actor', function (Blueprint $table) {
            $table->foreign(['actor_id'], 'fk_film_actor_actor')->references(['actor_id'])->on('actor')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['film_id'], 'fk_film_actor_film')->references(['film_id'])->on('film')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('film_actor', function (Blueprint $table) {
            $table->dropForeign('fk_film_actor_actor');
            $table->dropForeign('fk_film_actor_film');
        });
    }
};
