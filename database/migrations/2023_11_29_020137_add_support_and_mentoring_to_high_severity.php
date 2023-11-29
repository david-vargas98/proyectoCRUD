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
        Schema::table('high_severity', function (Blueprint $table) {
            $table->string('support_and_mentoring');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('high_severity', function (Blueprint $table) {
            $table->dropColumn('support_and_mentoring');
        });
    }
};
