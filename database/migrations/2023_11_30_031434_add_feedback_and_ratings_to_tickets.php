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
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedTinyInteger('sender_rating')->nullable();
            $table->text('sender_feedback')->nullable();
            $table->unsignedTinyInteger('receiver_rating')->nullable();
            $table->text('receiver_feedback')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {    
            $table->dropColumn('sender_rating');
            $table->dropColumn('sender_feedback');
            $table->dropColumn('receiver_rating');
            $table->dropColumn('receiver_feedback');
        });
    }
};
