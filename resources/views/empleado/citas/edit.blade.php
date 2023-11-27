@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>Editar cita del paciente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('citas.update', $cita) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="patient_id">Paciente agendado</label>
                    <input type="text" name="patient_id" class="form-control"
                        value="{{ $cita->patient->militaryElement->name }}" style="width: 250px;" disabled>
                    <input type="hidden" name="patient_id" value="{{ $cita->patient_id }}">
                    @error('patient_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="appointment_date">Fecha de la cita</label>
                    <input type="date" name="appointment_date" value="{{ $cita->appointment_date }}" class="form-control"
                        style="width: 250px;" disabled>
                    <input type="hidden" name="appointment_date" value="{{ $cita->appointment_date }}">
                    @error('appointment_date')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="start_time">Hora de inicio de la cita</label>
                    <input type="time" name="start_time" value="{{ $cita->start_time }}" class="form-control"
                        style="width: 250px;" disabled>
                    <input type="hidden" name="start_time" value="{{ $cita->start_time }}">
                    @error('start_time')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="end_time">Hora de fin de la cita</label>
                    @if ($cita->end_time == null)
                        <input type="time" name="end_time" class="form-control" style="width: 250px;" required>
                    @else
                        <input type="time" name="end_time" class="form-control" style="width: 250px;"
                            value="{{ $cita->end_time }}" disabled required>
                        <input type="hidden" name="end_time" value="{{ $cita->end_time }}" required>
                    @endif

                    @error('end_time')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="appointment_status">Estado de la cita</label>
                    <select name="appointment_status" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione un estado</option>
                        <option value="Programada" {{ $cita->appointment_status == 'Programada' ? 'selected' : '' }}>
                            Programada</option>
                        <option value="Cancelada" {{ $cita->appointment_status == 'Cancelada' ? 'selected' : '' }}>
                            Cancelada</option>
                        <option value="Completada" {{ $cita->appointment_status == 'Completada' ? 'selected' : '' }}>
                            Completada</option>
                    </select>
                    @error('appointment_status')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="contrato">Archivo</label>
                    @if ($cita->observations_name)
                        <div class="mb-2">
                            <p>Archivo actual: {{ $cita->observations_name }}</p>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-info mt-2 mr-2" href="{{ route('citas.ver', $cita) }}">
                                    <i class="far fa-eye"></i> Vizualizar archivo
                                </a>
                                <a class="btn btn-sm btn-success mt-2 mr-2" href="{{ route('citas.descargar', $cita) }}">
                                    <i class="fas fa-file-download"></i> Descargar archivo
                                </a>
                            </div>
                            <div class="form-check mt-2">
                                <input type="hidden" name="quitar_contrato" value="0">
                                <input type="checkbox" name="quitar_contrato" class="form-check-input">
                                <label for="quitar_contrato" class="form-check-label"></label> Quitar archivo actual
                            </div>
                        </div>
                        <p>Quitar y reemplazar por otro:</p>
                    @endif
                    <input type="file" name="contrato" class="form-control-file mt-2">
                    @error('contrato')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Actualizar cita
                    </button>
                    <a href="{{ route('citas.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-angle-double-left"></i> Regresar al índice
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
