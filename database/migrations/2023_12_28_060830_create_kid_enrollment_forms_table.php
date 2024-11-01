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
        Schema::create('kid_enrollment_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id');

            $table->foreign('kid_id')
            ->references('id')
            ->on('kids')
            ->onDelete('cascade');
            
            $table->string('surname')->nullable();
            $table->string('given_name')->nullable();
            $table->enum('sex',['male','female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('special_need')->default(0)->nullable();
            $table->tinyInteger('allergies_life_threatening')->default(0)->nullable();
            $table->tinyInteger('allergies_non_life_threatening')->default(0)->nullable();
            $table->tinyInteger('medical_condition')->default(0)->nullable();
            $table->tinyInteger('potty_trained')->default(0)->nullable();
            $table->tinyInteger('special_feeding_arrangements')->default(0)->nullable();
            $table->string('extra_concern')->nullable();

            $table->string('mother_surname')->nullable();
            $table->string('mother_given_name')->nullable();
            $table->string('mother_home_address')->nullable();
            $table->string('mother_postal_code')->nullable();
            $table->string('mother_cell_phone')->nullable();
            $table->string('mother_home_phone')->nullable();
            $table->string('mother_work_place')->nullable();
            $table->string('mother_work_address')->nullable();
            $table->string('mother_work_phone')->nullable();
            $table->string('mother_email')->nullable();
            $table->date('mother_date_of_birth')->nullable();
            $table->tinyInteger('mother_custody')->default(0)->nullable();

            $table->string('father_surname')->nullable();
            $table->string('father_given_name')->nullable();
            $table->string('father_home_address')->nullable();
            $table->string('father_postal_code')->nullable();
            $table->string('father_cell_phone')->nullable();
            $table->string('father_home_phone')->nullable();
            $table->string('father_work_place')->nullable();
            $table->string('father_work_address')->nullable();
            $table->string('father_work_phone')->nullable();
            $table->string('father_email')->nullable();
            $table->date('father_date_of_birth')->nullable();
            $table->tinyInteger('father_custody')->default(0)->nullable();

            $table->enum('type_of_care',['parttime','fulltime','before/after'])->nullable();
            $table->date('start_date')->nullable();
            $table->string('days_of_care')->nullable();
            $table->date('term_date')->nullable();
            $table->string('house_of_care')->nullable();

            $table->string('parent_sign')->nullable();
            $table->string('provider_sign')->nullable();
            $table->string('agency_sign')->nullable();
            $table->string('chiled_file_number')->nullable();
            $table->string('deposit_amount')->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_enrollment_forms');
    }
};
