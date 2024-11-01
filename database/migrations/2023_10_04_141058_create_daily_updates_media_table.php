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
        Schema::create('daily_updates_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daily_updates_id')->nullable();
            $table->foreign('daily_updates_id')->references('id')->on('daily_updates')->onDelete('cascade');
            $table->text('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_updates_media');
    }
};
