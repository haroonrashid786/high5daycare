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
        Schema::table('kid_anaphylactic_emergencies', function (Blueprint $table) {
            $table->string('emergency_contact_name_2')->nullable();
            $table->string('emergency_contact_relationship_2')->nullable();
            $table->string('emergency_contact_home_phone_2')->nullable();
            $table->string('emergency_contact_cell_phone_2')->nullable();
            $table->string('emergency_contact_work_phone_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kid_anaphylactic_emergencies', function (Blueprint $table) {
            //
        });
    }
};
