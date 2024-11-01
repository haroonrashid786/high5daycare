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
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
            $table->tinyInteger('present')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('kid_id');
            $table->dropColumn('present');

        });
    }
};
