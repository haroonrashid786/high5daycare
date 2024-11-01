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
        Schema::table('ministry_fundings', function (Blueprint $table) {
            $table->unsignedBigInteger('funding_category_id')->nullable();
            $table->foreign('funding_category_id')->references('id')->on('funding_categories')->onDelete('cascade');
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ministry_fundings', function (Blueprint $table) {
        $table->dropForeign(['funding_category_id']);
        $table->dropColumn('funding_category_id');
        $table->dropColumn('date');
        });
    }
};
