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
        Schema::table('kid_alternate_sleepings', function (Blueprint $table) {
           $table->time('awaking_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kid_altrnate_sleepings', function (Blueprint $table) {
            $table->dropColumn('awaking_time');
        });
    }
};
