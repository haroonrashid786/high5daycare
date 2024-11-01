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
        Schema::create('dispensing_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_medication_consent_id')->nullable();
            $table->date('date')->nullable();
            $table->string('item_given')->nullable();
            $table->string('dosage')->nullable();
            $table->string('signature')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->foreign('kid_medication_consent_id')->references('id')->on('kid_medication_consents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispensing_records');
    }
};
