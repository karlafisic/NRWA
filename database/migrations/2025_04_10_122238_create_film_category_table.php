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
        Schema::create('film_category', function (Blueprint $table) {
            $table->unsignedSmallInteger('film_id');
            $table->unsignedTinyInteger('category_id')->index('fk_film_category_category');
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['film_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_category');
    }
};
