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
        Schema::create('kid_release_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
            $table->string('child_name')->nullable();
            $table->string('name')->nullable();
            $table->string('home_address')->nullable();
            $table->string('relationship')->nullable();
            $table->string('place_of_work')->nullable();
            $table->string('work_address')->nullable();
            $table->string('cell_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('work_number')->nullable();
            $table->text('special_instructions')->nullable();
            $table->string('authorization_name')->nullable();
            $table->string('authorization_relationship')->nullable();
            $table->string('authorization_signature')->nullable();
            $table->date('authorization_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_release_information');
    }
};
