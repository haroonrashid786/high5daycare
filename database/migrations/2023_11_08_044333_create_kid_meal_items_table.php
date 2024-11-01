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
        Schema::create('kid_meal_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_meal_id')->nullable();
            $table->string('day')->nullable();
            $table->string('morning_snack')->nullable();
            $table->string('lunch')->nullable();
            $table->string('afternoon_snack')->nullable();
            $table->timestamps();
            $table->foreign('kid_meal_id')->references('id')->on('kid_meals')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_meal_items');
    }
};
