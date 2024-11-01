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
        Schema::create('provider_abouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->integer('family_members')->nullable();
            $table->integer('family_members_below_18')->nullable();
            $table->integer('family_members_above_18')->nullable();
            $table->json('courses')->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_abouts');
    }
};
