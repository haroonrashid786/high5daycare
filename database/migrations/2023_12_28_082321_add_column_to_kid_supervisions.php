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
        Schema::table('kid_supervisions', function (Blueprint $table) {
            $table->string('child_name')->nullable();
            $table->string('child_provider_name')->nullable();
            $table->string('child_provider_address')->nullable();

            $table->string('location_name_2')->nullable();
            $table->string('location_address_2')->nullable();
            $table->string('means_of_transport_2')->nullable();

            $table->string('location_name_3')->nullable();
            $table->string('location_address_3')->nullable();
            $table->string('means_of_transport_3')->nullable();

            $table->string('location_name_4')->nullable();
            $table->string('location_address_4')->nullable();
            $table->string('means_of_transport_4')->nullable();

            $table->string('location_name_5')->nullable();
            $table->string('location_address_5')->nullable();
            $table->string('means_of_transport_5')->nullable();

            $table->string('location_name_6')->nullable();
            $table->string('location_address_6')->nullable();
            $table->string('means_of_transport_6')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kid_supervisions', function (Blueprint $table) {
            $table->dropColumn('child_name');
            $table->dropColumn('child_provider_name');
            $table->dropColumn('child_provider_address');

            $table->dropColumn('location_name_2');
            $table->dropColumn('location_address_2');
            $table->dropColumn('means_of_transport_2');

            $table->dropColumn('location_name_3');
            $table->dropColumn('location_address_3');
            $table->dropColumn('means_of_transport_3');

            $table->dropColumn('location_name_4');
            $table->dropColumn('location_address_4');
            $table->dropColumn('means_of_transport_4');

            $table->dropColumn('location_name_5');
            $table->dropColumn('location_address_5');
            $table->dropColumn('means_of_transport_5');

            $table->dropColumn('location_name_6');
            $table->dropColumn('location_address_6');
            $table->dropColumn('means_of_transport_6');
        });
    }
};
