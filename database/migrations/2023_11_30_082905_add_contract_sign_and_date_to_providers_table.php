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
        Schema::table('daycare_providers', function (Blueprint $table) {
            $table->string('contract_signature')->nullable();
            $table->date('contract_signature_date')->nullable();
            $table->string('admin_signature')->nullable();
            $table->date('admin_signature_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daycare_providers', function (Blueprint $table) {
            $table->dropColumn('contract_signature');
            $table->dropColumn('contract_signature_date');
            $table->dropColumn('admin_signature');
            $table->dropColumn('admin_signature_date');
        });
    }
};
