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
        Schema::table('kid_emergency_information', function (Blueprint $table) {
            $table->string('child_name')->nullable();
            $table->string('emergency_contact_c_no')->nullable();
            $table->string('emergency_contact_p_no')->nullable();

            $table->string('emergency_contact_surname_2')->nullable();
            $table->string('emergency_contact_first_name_2')->nullable();
            $table->string('emergency_contact_address_2')->nullable();
            $table->string('emergency_contact_relationship_2')->nullable();
            $table->string('emergency_contact_c_no_2')->nullable();
            $table->string('emergency_contact_p_no_2')->nullable();

            $table->string('emergency_contact_surname_3')->nullable();
            $table->string('emergency_contact_first_name_3')->nullable();
            $table->string('emergency_contact_address_3')->nullable();
            $table->string('emergency_contact_relationship_3')->nullable();
            $table->string('emergency_contact_c_no_3')->nullable();
            $table->string('emergency_contact_p_no_3')->nullable();

            $table->string('emergency_contact_surname_4')->nullable();
            $table->string('emergency_contact_first_name_4')->nullable();
            $table->string('emergency_contact_address_4')->nullable();
            $table->string('emergency_contact_relationship_4')->nullable();
            $table->string('emergency_contact_c_no_4')->nullable();
            $table->string('emergency_contact_p_no_4')->nullable();

            $table->string('health_card_number_2')->nullable();
            $table->date('health_card_dob_2')->nullable();
            $table->string('allergies_2')->nullable();
            $table->string('health_conditions_2')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kid_emergency_information', function (Blueprint $table) {
            
            $table->dropColumn([
                'child_name',
                'emergency_contact_c_no',
                'emergency_contact_p_no',
                'emergency_contact_surname_2',
                'emergency_contact_first_name_2',
                'emergency_contact_address_2',
                'emergency_contact_relationship_2',
                'emergency_contact_c_no_2',
                'emergency_contact_p_no_2',
                'emergency_contact_surname_3',
                'emergency_contact_first_name_3',
                'emergency_contact_address_3',
                'emergency_contact_relationship_3',
                'emergency_contact_c_no_3',
                'emergency_contact_p_no_3',
                'emergency_contact_surname_4',
                'emergency_contact_first_name_4',
                'emergency_contact_address_4',
                'emergency_contact_relationship_4',
                'emergency_contact_c_no_4',
                'emergency_contact_p_no_4',
                'health_card_number_2',
                'health_card_dob_2',
                'allergies_2',
                'health_conditions_2',
            ]);
            
        });
    }
};
