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
        Schema::table('activity_sheets', function (Blueprint $table) {
        $table->unsignedBigInteger('provider_id')->nullable();
        $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
        $table->unsignedBigInteger('kid_id')->nullable();
        $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_sheets', function (Blueprint $table) {
            $table->dropColumn('provider_id');
            $table->dropColumn('kid_id');

        });
    }
};
