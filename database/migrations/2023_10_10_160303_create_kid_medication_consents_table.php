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
        Schema::create('kid_medication_consents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->string('child_name')->nullable();
            $table->string('address')->nullable();
            $table->string('physician_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('medication_name')->nullable();
            $table->date('medication_prescribed_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('dosage')->nullable();
            $table->string('parent_times_given')->nullable();
            $table->string('provider_times_given')->nullable();
            $table->string('provider_amount_given')->nullable();
            $table->text('storage_instructions')->nullable();
            $table->text('side_effects')->nullable();
            $table->string('parent_signature')->nullable();
            $table->timestamps();

            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_medication_consents');
    }
};
