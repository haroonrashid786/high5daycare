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
        Schema::create('day_care_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
            $table->string('payment_number')->nullable();
            $table->integer('total_no_of_days')->nullable();
            $table->double('total',8,2)->nullable();
            $table->double('balance',8,2)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_care_payments');
    }
    
};
