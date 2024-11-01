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
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
            $table->double('previous_balance',8,2)->default(0)->nullable();
            $table->double('balance',8,2)->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['kid_id']);
            $table->dropColumn('kid_id');
            $table->dropColumn('previous_balance');
            $table->dropColumn('balance');
        });
    }
};
