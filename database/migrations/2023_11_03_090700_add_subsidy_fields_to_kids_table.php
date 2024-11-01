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
            $table->tinyInteger('is_subsidized')->default(0)->nullable();
            $table->date('subsidized_from')->nullable();
            $table->date('subsidized_to')->nullable();
            $table->double('subsidized_percentage',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kids', function (Blueprint $table) {
            $table->dropColumn('is_subsidized');
            $table->dropColumn('subsidized_from');
            $table->dropColumn('subsidized_to');
            $table->dropColumn('subsidized_percentage');

        });
    }
};
