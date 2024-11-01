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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_sheet_id')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('monday_activities')->nullable();
            $table->string('tuesday_activities')->nullable();
            $table->string('wednesday_activities')->nullable();
            $table->string('thursday_activities')->nullable();
            $table->string('friday_activities')->nullable();
            $table->string('saturday_activities')->nullable();
            $table->string('sunday_activities')->nullable();
            $table->string('activities_adjustment')->nullable();
            $table->timestamps();
            $table->foreign('activity_sheet_id')->references('id')->on('activity_sheets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
