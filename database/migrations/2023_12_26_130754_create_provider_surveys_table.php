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
        Schema::create('provider_surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->enum('q1',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q2',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q3',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q4',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q5',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q6',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q7',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q8',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q9',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q10',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->enum('q11',['stronglydisagree','disagree','neutral','agree','stronglyagree'])->default('neutral')->nullable();
            $table->integer('q12')->default(0)->nullable();
            $table->integer('q13')->default(0)->nullable();
            $table->integer('q14')->default(0)->nullable();
            $table->integer('q15')->default(0)->nullable();
            $table->integer('q16')->default(0)->nullable();
            $table->text('q17')->nullable();
            $table->text('q18')->nullable();
            $table->text('q19')->nullable();
            $table->text('q20')->nullable();
            $table->text('q21')->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_surveys');
    }
};
