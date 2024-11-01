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
        Schema::create('kid_emergency_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
            $table->string('doctor_name')->nullable();
            $table->string('doctor_address')->nullable();
            $table->string('medical_center')->nullable();
            $table->string('doctor_phone')->nullable();
            $table->string('emergency_contact_surname')->nullable();
            $table->string('emergency_contact_first_name')->nullable();
            $table->string('emergency_contact_address')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('health_card_number')->nullable();
            $table->date('health_card_dob')->nullable();
            $table->string('allergies')->nullable();
            $table->string('health_conditions')->nullable();
            $table->string('parent_signature')->nullable();
            $table->date('parent_signature_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_emergency_information');
    }
};
