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
            $table->double('infant_percentage',8,2)->default(0)->nullable();
            $table->double('toddler_percentage',8,2)->default(0)->nullable();
            $table->double('pre_school_percentage',8,2)->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daycare_providers', function (Blueprint $table) {
            $table->dropColumn('infant_percentage');
            $table->dropColumn('toddler_percentage');
            $table->dropColumn('pre_school_percentage');
        });
    }
};
