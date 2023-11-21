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
                <th>Estado de la cita</th>
                <th colspan="2">Observaciones y detalles</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-sm">{{ $cita->patient->militaryElement->name }}</td>
                <td class="text-sm">{{ $cita->patient->userPsicologo->name }}</td>
                <td class="text-sm">{{ $cita->appointment_date }}</td>
                <td class="text-sm">{{ $cita->start_time }}</td>
                @if ($cita->end_time != null)
                    <td class="text-sm">{{ $cita->end_time }}</td>
                @else
                    <td class="text-danger">No se estableció hora de fin</td>
                @endif
                <td class="text-sm">{{ $cita->appointment_status }}</td>
                @if ($cita->observations_location != null)
                    <td>
                        <a class="btn btn-sm btn-info mt-2 mr-2"
                            href="{{ route('citas.ver', $cita) }}">
                            <i class="far fa-eye"></i> Vizualizar archivo
                        </a>
                    </td>
                    <td class="text-sm">
                        <a class="btn btn-sm btn-success mt-2 mr-2" href="{{ route('citas.descargar', $cita) }}">
                            <i class="fas fa-file-download"></i> Descargar archivo
                        </a>
                    </td>
                @else
                    <td class="text-danger">No se anexó ningún archivo</td>
                @endif
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <a href="{{ route('citas.index') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-angle-double-left"></i> Regresar al índice
        </a>
    </div>
@stop
