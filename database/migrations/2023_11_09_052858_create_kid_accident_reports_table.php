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
        Schema::create('kid_accident_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->string('incident_number')->nullable();
            $table->date('accident_date')->nullable();
            $table->time('accident_time')->nullable();
            $table->string('location')->nullable();
            $table->string('observer')->nullable();
            $table->json('nature_of_injury')->nullable();
            $table->string('other_injury')->nullable();
            $table->text('description')->nullable();
            $table->text('first_aid')->nullable();
            $table->tinyInteger('phone_notified')->default(0)->nullable();
            $table->time('phone_notified_time')->nullable();
            $table->string('phone_notified_by')->nullable();
            $table->tinyInteger('voicemail_notified')->default(0)->nullable();
            $table->time('voicemail_notified_time')->nullable();
            $table->string('voicemail_notified_by')->nullable();
            $table->tinyInteger('email_notified')->default(0)->nullable();
            $table->time('email_notified_time')->nullable();
            $table->string('email_notified_by')->nullable();
            $table->tinyInteger('in_person_notified')->default(0)->nullable();
            $table->time('in_person_notified_time')->nullable();
            $table->string('in_person_notified_by')->nullable();
            $table->string('report_provided_by')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_signature')->nullable();
            $table->string('provider_signature')->nullable();
            $table->string('childcare_provider_name')->nullable();
            $table->string('childcare_provider_address')->nullable();
            $table->tinyInteger('same_as_provider')->default(0)->nullable();
            $table->string('filled_by')->nullable();
            $table->string('signature_filled_by')->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_accident_reports');
    }
};
