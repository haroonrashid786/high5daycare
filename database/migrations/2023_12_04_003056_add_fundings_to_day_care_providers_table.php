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
            $table->double('ministry_funding',8,2)->nullable();
            $table->double('hceg_funding',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daycare_providers', function (Blueprint $table) {
            $table->dropColumn('ministry_funding');
            $table->dropColumn('hceg_funding');
        });
    }
};
