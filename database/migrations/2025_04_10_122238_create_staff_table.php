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
        Schema::create('staff', function (Blueprint $table) {
            $table->tinyIncrements('staff_id');
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->unsignedSmallInteger('address_id')->index('idx_fk_address_id');
            $table->binary('picture')->nullable();
            $table->string('email', 50)->nullable();
            $table->unsignedTinyInteger('store_id')->index('idx_fk_store_id');
            $table->boolean('active')->default(true);
            $table->string('username', 16);
            $table->string('password', 40)->nullable();
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
