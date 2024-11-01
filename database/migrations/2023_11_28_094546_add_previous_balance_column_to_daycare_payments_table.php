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

            $table->double('net_amount',8,2)->default(0)->nullable();
            $table->double('previous_balance',8,2)->default(0)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('day_care_payments', function (Blueprint $table) {

            $table->dropColumn('net_amount');
            $table->dropColumn('previous_balance');

        });
    }
};
