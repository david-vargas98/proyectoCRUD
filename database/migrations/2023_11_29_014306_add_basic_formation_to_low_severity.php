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
        Schema::table('low_severity', function (Blueprint $table) {
            $table->string('basic_formation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('low_severity', function (Blueprint $table) {
            $table->dropColumn('basic_formation');
        });
    }
};
