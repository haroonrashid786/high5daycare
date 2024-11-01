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
        Schema::table('kid_release_information', function (Blueprint $table) {
            
            $table->string('name_2')->nullable();
            $table->string('home_address_2')->nullable();
            $table->string('relationship_2')->nullable();
            $table->string('place_of_work_2')->nullable();
            $table->string('work_address_2')->nullable();
            $table->string('cell_number_2')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->string('work_number_2')->nullable();
            
            $table->string('name_3')->nullable();
            $table->string('home_address_3')->nullable();
            $table->string('relationship_3')->nullable();
            $table->string('place_of_work_3')->nullable();
            $table->string('work_address_3')->nullable();
            $table->string('cell_number_3')->nullable();
            $table->string('phone_number_3')->nullable();
            $table->string('work_number_3')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kid_release_information', function (Blueprint $table) {
            //
        });
    }
};
