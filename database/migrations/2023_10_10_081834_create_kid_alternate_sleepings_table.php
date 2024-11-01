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
        Schema::create('kid_alternate_sleepings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('child_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('sleeping_problems')->default(0)->nullable();
            $table->string('sleeping_problem_type')->nullable();
            $table->string('night_sleep_duration')->nullable();
            $table->time('day_sleep_pattern')->nullable();
            $table->string('sleeping_position')->nullable();
            $table->tinyInteger('special_ways_to_sleep')->default(0)->nullable();
            $table->tinyInteger('cries_before_sleep')->default(0)->nullable();
            $table->tinyInteger('cries_after_waking_up')->default(0)->nullable();
            $table->tinyInteger('sleeps_in_own_room')->default(0)->nullable();
            $table->tinyInteger('sleeps_in_own_crib_bed')->default(0)->nullable();
            $table->string('special_toys_blanket')->nullable();
            $table->string('consent_to_sleep_on_cot')->nullable();
            $table->string('consent_to_sleep_on_playpen')->nullable();
            $table->string('consent_to_sleep_on_provider_bed')->nullable();
            $table->string('consent_to_sleep_on_couch')->nullable();
            $table->string('consent_to_sleep_on_other')->nullable();
            $table->string('parent_signature')->nullable();
            $table->timestamps();
             // Define foreign key constraint
             $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_alternate_sleepings');
    }
};
