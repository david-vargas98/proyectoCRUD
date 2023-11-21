@extends('adminlte::page')

@section('title', 'Agregar')

@section('content_header')
    <h1>Agendar cita con paciente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('citas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="patient_id">Paciente a agendar</label>
                    <select name="patient_id" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Selecciona un paciente</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">
                                {{ $paciente->militaryElement->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="appointment_date">Fecha de la cita</label>
                    <input type="date" name="appointment_date" class="form-control" style="width: 250px;" required>
                    @error('appointment_date')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="start_time">Hora de inicio de la cita</label>
                    <input type="time" name="start_time" class="form-control" style="width: 250px;" required>
                    @error('start_time')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    {{-- <label for="end_time">Hora de fin de la cita</label>
                    <input type="time" id="end_time" class="form-control" style="width: 250px;" required>
                    @error('end_time')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror --}}

                    <label for="appointment_status">Estado de la cita</label>
                    <select name="appointment_status" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione un estado</option>
                        <option value="Programada">Programada</option>
                        <option value="Cancelada">Cancelada</option>
                        <option value="Completada">Completada</option>
                    </select>
                    @error('appointment_status')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Agregar cita</button>
            </form>
        </div>
    </div>
@stop
