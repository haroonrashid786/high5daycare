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
        Schema::create('day_care_vacations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->unsignedBigInteger('alternate_provider_id')->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
            $table->foreign('alternate_provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_care_vacations');
    }
};
