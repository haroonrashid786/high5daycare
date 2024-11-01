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
        Schema::create('kid_drug_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->unsignedBigInteger('drug_id')->nullable();
            $table->string('drug_name')->nullable();
            $table->tinyInteger('allowed')->default(0)->nullable();
            $table->string('brand')->nullable();
            $table->string('comments')->nullable();
            $table->string('parent_signature')->nullable();
            $table->timestamps();
            // Define foreign key constraint
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kid_drug_information');
    }
};
