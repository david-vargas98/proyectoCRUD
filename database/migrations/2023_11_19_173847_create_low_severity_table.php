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
        Schema::create('low_severity', function (Blueprint $table) {
            $table->id();
            $table->string('engineer_services');
            $table->string('management_services');
            $table->string('health_services');
            $table->string('war_material_services');
            $table->string('transmission_services');
            $table->string('transport_services');
            $table->string('quartermasters_corp');
            $table->string('justice_services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('low_severity');
    }
};
