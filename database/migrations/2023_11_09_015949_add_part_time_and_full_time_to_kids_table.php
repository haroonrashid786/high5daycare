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
        Schema::table('kids', function (Blueprint $table) {
            $table->tinyInteger('is_part_time')->default(0)->nullable();
            $table->json('selected_days')->nullable();
            $table->text('subsidized_certificate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kids', function (Blueprint $table) {
            $table->dropColumn('is_part_time');
            $table->dropColumn('selected_days');
            $table->dropColumn('subsidized_certificate');
        });
    }
};
