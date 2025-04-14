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
        Schema::create('rental', function (Blueprint $table) {
            $table->integer('rental_id', true);
            $table->dateTime('rental_date');
            $table->unsignedMediumInteger('inventory_id')->index('idx_fk_inventory_id');
            $table->unsignedSmallInteger('customer_id')->index('idx_fk_customer_id');
            $table->dateTime('return_date')->nullable();
            $table->unsignedTinyInteger('staff_id')->index('idx_fk_staff_id');
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();

            $table->unique(['rental_date', 'inventory_id', 'customer_id'], 'rental_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental');
    }
};
