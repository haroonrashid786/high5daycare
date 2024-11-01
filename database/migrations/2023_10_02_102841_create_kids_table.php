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

        Schema::create('kids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
            $table->string('full_name')->nullable();
            $table->double('age',8,2)->nullable();
            $table->string('contact_number')->nullable();
            $table->text('profile_picture')->nullable();
            $table->text('allergies')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('photo_permission')->default(0)->nullable();
            $table->tinyInteger('subsidy_eligibility')->default(0)->nullable();
            $table->date('school_start')->nullable();
            $table->dateTime('contract_start')->nullable();
            $table->dateTime('contract_end')->nullable();
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kids');
    }
};
