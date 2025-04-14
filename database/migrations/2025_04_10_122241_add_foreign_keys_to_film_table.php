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
        Schema::table('film', function (Blueprint $table) {
            $table->foreign(['language_id'], 'fk_film_language')->references(['language_id'])->on('language')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['original_language_id'], 'fk_film_language_original')->references(['language_id'])->on('language')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('film', function (Blueprint $table) {
            $table->dropForeign('fk_film_language');
            $table->dropForeign('fk_film_language_original');
        });
    }
};
