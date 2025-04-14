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
        Schema::create('customer', function (Blueprint $table) {
            $table->smallIncrements('customer_id');
            $table->unsignedTinyInteger('store_id')->index('idx_fk_store_id');
            $table->string('first_name', 45);
            $table->string('last_name', 45)->index('idx_last_name');
            $table->string('email', 50)->nullable();
            $table->unsignedSmallInteger('address_id')->index('idx_fk_address_id');
            $table->boolean('active')->default(true);
            $table->dateTime('create_date');
            $table->timestamp('last_update')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
