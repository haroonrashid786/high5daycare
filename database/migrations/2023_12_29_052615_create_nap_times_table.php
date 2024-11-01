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
        Schema::create('nap_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('kid_id');
            $table->date('date')->nullable();
            $table->time('sleeping_time')->nullable();
            $table->time('awaking_time')->nullable();
            $table->time('checking_time')->nullable();

            $table->foreign('provider_id')
            ->references('id')
            ->on('daycare_providers')
            ->onDelete('cascade');

            $table->foreign('kid_id')
            ->references('id')
            ->on('kids')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nap_times');
    }
};
