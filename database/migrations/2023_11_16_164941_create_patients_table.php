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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('military_element_id');
            $table->foreign('military_element_id')->references('id')->on('military_elements');
            $table->unsignedBigInteger('user_id')->nullable(); //Se agrega la nueva columna user_id
            $table->foreign('user_id')->references('id')->on('users'); //Se establece la clave foránea
            $table->string('disorder');
            $table->string('severity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
