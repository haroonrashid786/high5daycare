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
        Schema::table('kid_drug_information', function (Blueprint $table) {
            $table->string('parent_name')->nullable();
            $table->string('child_name')->nullable();
            $table->string('dob')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kid_drug_information', function (Blueprint $table) {
            $table->dropColumn(['parent_name','child_name','dob']);
        });
    }
};
