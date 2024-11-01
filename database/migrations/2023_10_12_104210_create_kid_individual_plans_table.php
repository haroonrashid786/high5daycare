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
        Schema::create('kid_individual_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->string('child_name')->nullable();
            $table->string('child_home_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('child_care_provider')->nullable();
            $table->string('child_care_address')->nullable();
            $table->string('child_care_phone')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone_work')->nullable();
            $table->string('emergency_contact_phone_cell')->nullable();
            $table->string('emergency_contact_phone_home')->nullable();
            $table->string('observed_requirements')->nullable();
            $table->string('call_parent_guardian')->nullable();
            $table->string('parent_guardian_name')->nullable();
            $table->string('parent_guardian_phone_work')->nullable();
            $table->string('parent_guardian_phone_cell')->nullable();
            $table->string('parent_guardian_phone_home')->nullable();
            $table->string('call_911')->nullable();
            $table->string('call_doctor')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('doctor_phone')->nullable();
            $table->string('medication_name')->nullable();
            $table->string('dose')->nullable();
            $table->string('signature')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_individual_plans');
    }
};
