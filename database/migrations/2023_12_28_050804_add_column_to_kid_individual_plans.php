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
        Schema::table('kid_individual_plans', function (Blueprint $table) {
            $table->string('medical_condition')->nullable();
            $table->string('symptoms')->nullable();
            $table->tinyInteger('acute')->default(0)->nullable();
            $table->tinyInteger('chronic')->default(0)->nullable();
            $table->string('triggers')->nullable();
            $table->string('other_information')->nullable();
            $table->string('daily_modification')->nullable();
            $table->string('medical_devices')->nullable();
            $table->string('support')->nullable();
            $table->string('evacuation_procedure')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kid_individual_plans', function (Blueprint $table) {
            $table->dropColumn('medical_condition');
            $table->dropColumn('symptoms');
            $table->dropColumn('acute');
            $table->dropColumn('chronic');
            $table->dropColumn('triggers');
            $table->dropColumn('other_information');
            $table->dropColumn('daily_modification');
            $table->dropColumn('medical_devices');
            $table->dropColumn('support');
            $table->dropColumn('evacuation_procedure');
        });
    }
};
