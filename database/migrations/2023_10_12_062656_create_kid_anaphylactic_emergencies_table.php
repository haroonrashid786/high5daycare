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
        Schema::create('kid_anaphylactic_emergencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->string('child_name')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('peanuts')->default(0)->nullable();
            $table->tinyInteger('tree_nuts')->default(0)->nullable();
            $table->tinyInteger('eggs')->default(0)->nullable();
            $table->tinyInteger('milk')->default(0)->nullable();
            $table->string('insect_stings')->nullable();
            $table->string('latex')->nullable();
            $table->string('medications')->nullable();
            $table->string('others')->nullable();
            $table->tinyInteger('epipen_jr')->default(0)->nullable();
            $table->tinyInteger('epipen')->default(0)->nullable();
            $table->tinyInteger('twinjet_015mg')->default(0)->nullable();
            $table->tinyInteger('twinjet_030mg')->default(0)->nullable();
            $table->string('location_of_auto_injectors')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_home_phone')->nullable();
            $table->string('emergency_contact_cell_phone')->nullable();
            $table->string('emergency_contact_work_phone')->nullable();
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
        Schema::dropIfExists('kid_anaphylactic_emergencies');
    }
};
