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
        Schema::create('subsidized_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->string('certificate_file_path')->nullable();
            $table->timestamps();
        
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsidized_certificates');
    }
};
