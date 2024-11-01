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
        Schema::table('day_care_payment_items', function (Blueprint $table) {
            $table->tinyInteger('first_fortnight')->default(0)->nullable();
            $table->tinyInteger('second_fortnight')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('day_care_payment_items', function (Blueprint $table) {
            $table->dropColumn('first_fortnight');
            $table->dropColumn('second_fortnight');
        });
    }
};
