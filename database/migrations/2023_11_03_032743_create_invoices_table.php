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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('invoice_number')->nullable();
            $table->integer('total_presence')->default(0)->nullable();
            $table->decimal('total', 8, 2)->default(0)->nullable();
            $table->decimal('ministry_amount', 8, 2)->default(0)->nullable();
            $table->decimal('grand_total', 8, 2)->nullable(); 
            $table->tinyInteger('status')->default(0)->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('daycare_providers')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
