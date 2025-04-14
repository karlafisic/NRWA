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
        Schema::create('address', function (Blueprint $table) {
            $table->smallIncrements('address_id');
            $table->string('address', 50);
            $table->string('address2', 50)->nullable();
            $table->string('district', 20);
            $table->unsignedSmallInteger('city_id')->index('idx_fk_city_id');
            $table->string('postal_code', 10)->nullable();
            $table->string('phone', 20);
            $table->geography('location', null, 0);
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();

            $table->spatialIndex(['location'], 'idx_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
