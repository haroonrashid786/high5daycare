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
        Schema::create('ministry_fundings', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->double('amount',8,2)->nullable();
            $table->double('balance',8,2)->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ministry_fundings');
    }
};
