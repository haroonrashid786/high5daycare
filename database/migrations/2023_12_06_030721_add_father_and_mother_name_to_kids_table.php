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
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kids', function (Blueprint $table) {
            $table->dropColumn('father_name');
            $table->dropColumn('mother_name');
        });
    }
};
