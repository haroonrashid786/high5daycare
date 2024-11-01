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
        Schema::create('provider_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_images');
    }
};
