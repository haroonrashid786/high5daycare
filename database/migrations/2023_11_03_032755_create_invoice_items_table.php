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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('kid_id')->nullable();
            $table->integer('kid_age')->nullable();
            $table->integer('presence_count')->nullable();
            $table->decimal('rate', 8, 2)->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->decimal('ministry_share', 8, 2)->nullable();
            $table->decimal('kid_total', 8, 2)->nullable();
            $table->decimal('balance', 8, 2)->default(0)->nullable();
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
