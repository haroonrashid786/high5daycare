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
        Schema::create('parent_surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('q1')->default(0)->nullable();
            $table->tinyInteger('q2')->default(0)->nullable();
            $table->tinyInteger('q3')->default(0)->nullable();
            $table->tinyInteger('q4')->default(0)->nullable();
            $table->tinyInteger('q5')->default(0)->nullable();
            $table->bigInteger('q6')->nullable();
            $table->tinyInteger('q7')->default(0)->nullable();
            $table->tinyInteger('q8')->default(0)->nullable();
            $table->tinyInteger('q9')->default(0)->nullable();
            $table->bigInteger('q10')->nullable();
            $table->tinyInteger('q11')->default(0)->nullable();
            $table->bigInteger('q12')->nullable();
            $table->tinyInteger('q13')->default(0)->nullable();
            $table->tinyInteger('q14')->default(0)->nullable();
            $table->bigInteger('q15')->nullable();
            $table->tinyInteger('q16')->default(0)->nullable();
            $table->longText('q17')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_surveys');
    }
};
