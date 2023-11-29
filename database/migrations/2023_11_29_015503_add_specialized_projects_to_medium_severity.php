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
        Schema::table('medium_severity', function (Blueprint $table) {
            $table->string('specialized_projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medium_severity', function (Blueprint $table) {
            $table->dropColumn('specialized_projects');
        });
    }
};
