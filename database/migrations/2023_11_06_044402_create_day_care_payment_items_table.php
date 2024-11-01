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
        Schema::create('day_care_payment_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->integer('kid_age')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->decimal('rate', 8, 2)->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->timestamps();
            $table->foreign('payment_id')->references('id')->on('day_care_payments')->onDelete('cascade');
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_care_payment_items');
    }
};
