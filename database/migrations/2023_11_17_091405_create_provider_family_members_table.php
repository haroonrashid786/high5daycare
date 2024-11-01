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
        Schema::create('provider_family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_about_id')->nullable();
            $table->string('family_member_name')->nullable();
            $table->text('police_certificate')->nullable();
            $table->timestamps();
            $table->foreign('provider_about_id')->references('id')->on('provider_abouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_family_members');
    }
};
