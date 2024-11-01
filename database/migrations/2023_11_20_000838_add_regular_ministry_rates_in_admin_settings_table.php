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
            $table->double('ministry_rate_infant',8,2)->nullable();
            $table->double('ministry_rate_toddler',8,2)->nullable();
            $table->double('ministry_rate_pre_school',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_settings', function (Blueprint $table) {
            $table->dropColumn('ministry_rate_infant');
            $table->dropColumn('ministry_rate_toddler');
            $table->dropColumn('ministry_rate_pre_school');
        });
    }
};
