@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1>Detalles de la cita</h1>
@stop

@section('content')
    {{-- Mensaje de confirmación --}}
    @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
    @endif
    <table border="1" class="text-center table table-bordered table-striped table-hover">
        <thead>
            <tr class="text-sm">
                <th>Paciente</th>
                <th>Psicólogo</th>
                <th>Fecha de la cita</th>
                <th>Hora de inicio</th>
                <th>Hora de fin</th>
                <th>Observaciones y detalles</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-sm">{{ $cita->patient->militaryElement->name }}</td>
                <td class="text-sm">{{ $cita->patient->userPsicologo->name }}</td>
                <td class="text-sm">{{ $cita->appointment_date }}</td>
                <td class="text-sm">{{ $cita->start_time }}</td>
                <td class="text-sm">{{ $cita->end_time }}</td>
                @if ($cita->observations_location != null)
                    <td class="text-sm">{{ $cita->observations_location }}</td>
                @else
                    <td class="text-danger">No se anexó ningún archivo</td>
                @endif
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <a href="{{route('citas.index')}}" class="btn btn-sm btn-primary">
            <i class="fas fa-angle-double-left"></i> Regresar al índice
        </a>
    </div>
@stop