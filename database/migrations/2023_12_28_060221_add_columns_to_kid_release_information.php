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
            $table->text('special_instructions_2')->nullable();
            $table->text('special_instructions_3')->nullable();
            
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
