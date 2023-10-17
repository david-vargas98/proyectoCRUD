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
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('insumodescripcion');
            $table->integer('insumocantidad');
            //Campo que será la llave foránea
            $table->unsignedBigInteger('id_inventario');
            //Se agrega la llave foránea al campo
            $table->foreign('id_inventario')->references('id')->on('inventarios');
            //Otra manera de hacerlo: $table->foreignId('id_inventario')->constrained(); Hace lo mismo, pero es más concisa y moderna
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
