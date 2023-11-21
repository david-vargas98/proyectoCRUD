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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            //Se crea y referencia a la tabla de pacientes
            $table->unsignedBigInteger('patient_id');
            //Restricción de clave foránea
            $table->foreign('patient_id')->references('id')->on('patients');
            //la fecha de la cita
            $table->date('appointment_date');
            //Columnas de inicio y fin de cita
            $table->time('start_time');
            $table->time('end_time')->nullable();
            //El estado de la cita (programada, cancelada, completada)
            $table->string('appointment_status');
            //Columnas para el manejo de archivos:
            $table->string('observations_location')->nullable(); //Localización de archivos
            $table->string('observations_name')->nullable(); //Nombre del archivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
