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
        Schema::create('payment', function (Blueprint $table) {
            $table->smallIncrements('payment_id');
            $table->unsignedSmallInteger('customer_id')->index('idx_fk_customer_id');
            $table->unsignedTinyInteger('staff_id')->index('idx_fk_staff_id');
            $table->integer('rental_id')->nullable()->index('fk_payment_rental');
            $table->decimal('amount', 5);
            $table->dateTime('payment_date');
            $table->timestamp('last_update')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
