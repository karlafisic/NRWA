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
        Schema::create('film_text', function (Blueprint $table) {
            $table->unsignedSmallInteger('film_id')->primary();
            $table->string('title');
            $table->text('description')->nullable();

            $table->fullText(['title', 'description'], 'idx_title_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_text');
    }
};
