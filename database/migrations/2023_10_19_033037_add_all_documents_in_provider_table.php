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
        Schema::table('daycare_providers', function (Blueprint $table) {
            $table->string('postal_code')->nullable();
            $table->text('location_link')->nullable();
            $table->string('program_statement_signature')->nullable();
            $table->string('behavioral_managements_signature')->nullable();
            $table->string('provider_responsibility_signature')->nullable();
            $table->string('thrc_membership_num')->nullable();
            $table->string('fire_inspection_certificate')->nullable();
            $table->string('health_assessment_certificate')->nullable();
            $table->string('cpr')->nullable();
            $table->string('fire_evacuation_program')->nullable();
            $table->string('insurance')->nullable();
            $table->string('contract')->nullable();
            $table->string('food_handler')->nullable();
            $table->string('offence_declaration')->nullable();
            $table->string('notice_of_personal_information_collection')->nullable();
            $table->string('covid_vaccine')->nullable();
            $table->string('sign_of_policies')->nullable();
            $table->string('landlord_approval_letter')->nullable();
            $table->string('pet_vaccination')->nullable();
            $table->string('additional_certification')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daycare_providers', function (Blueprint $table) {
            $table->dropColumn('postal_code');
            $table->dropColumn('location_link');
            $table->dropColumn('thrc_membership_num');
            $table->dropColumn('program_statement_signature');
            $table->dropColumn('behavioral_managements_signature');
            $table->dropColumn('provider_responsibility_signature');
            $table->dropColumn('fire_inspection_certificate');
            $table->dropColumn('health_assessment_certificate');
            $table->dropColumn('cpr');
            $table->dropColumn('fire_evacuation_program');
            $table->dropColumn('insurance');
            $table->dropColumn('contract');
            $table->dropColumn('food_handler');
            $table->dropColumn('offence_declaration');
            $table->dropColumn('notice_of_personal_information_collection');
            $table->dropColumn('covid_vaccine');
            $table->dropColumn('sign_of_policies');
            $table->dropColumn('landlord_approval_letter');
            $table->dropColumn('pet_vaccination');
            $table->dropColumn('additional_certification');

        });
    }
};
