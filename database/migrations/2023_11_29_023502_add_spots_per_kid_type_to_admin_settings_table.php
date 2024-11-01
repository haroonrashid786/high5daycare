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
        Schema::table('admin_settings', function (Blueprint $table) {

        $table->integer('infants_allowed_to_provider')->nullable();
        $table->integer('toddlers_allowed_to_provider')->nullable();
        $table->integer('pre_schoolers_allowed_to_provider')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_settings', function (Blueprint $table) {
            
            $table->dropColumn('infants_allowed_to_provider');
            $table->dropColumn('toddlers_allowed_to_provider');
            $table->dropColumn('pre_schoolers_allowed_to_provider');

        });
    }
};
