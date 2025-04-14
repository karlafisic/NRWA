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
        Schema::create('film', function (Blueprint $table) {
            $table->smallIncrements('film_id');
            $table->string('title', 128)->index('idx_title');
            $table->text('description')->nullable();
            $table->year('release_year')->nullable();
            $table->unsignedTinyInteger('language_id')->index('idx_fk_language_id');
            $table->unsignedTinyInteger('original_language_id')->nullable()->index('idx_fk_original_language_id');
            $table->unsignedTinyInteger('rental_duration')->default(3);
            $table->decimal('rental_rate', 4)->default(4.99);
            $table->unsignedSmallInteger('length')->nullable();
            $table->decimal('replacement_cost', 5)->default(19.99);
            $table->enum('rating', ['G', 'PG', 'PG-13', 'R', 'NC-17'])->nullable()->default('G');
            $table->set('special_features', ['Trailers', 'Commentaries', 'Deleted Scenes', 'Behind the Scenes'])->nullable();
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film');
    }
};
