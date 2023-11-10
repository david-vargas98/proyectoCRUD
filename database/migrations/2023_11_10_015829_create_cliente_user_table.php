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
        Schema::create('cliente_user', function (Blueprint $table) {
            //Columna FK que hace referencia a clientes
            $table->unsignedBigInteger('cliente_id');
            //Asignación de FK
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            //Column FK que hace referencia a usuarios
            $table->unsignedBigInteger('user_id');
            //Asignación de FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //Otros atributos
            $table->string('proyecto');
            $table->float('presupuesto');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_user');
    }
};
