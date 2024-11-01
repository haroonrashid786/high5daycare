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
        Schema::table('day_care_payments', function (Blueprint $table) {
            $table->double('hceg_fund',8,2)->nullable();
            $table->double('gog_fund',8,2)->nullable();
            $table->integer('provider_presence')->nullable();

        });
    }

/**day
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('day_care_payments', function (Blueprint $table) {
            $table->dropColumn('hceg_fund');
            $table->dropColumn('gog_fund');
            $table->dropColumn('provider_presence');

        });
    }
};
