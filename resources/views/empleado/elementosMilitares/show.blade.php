@extends('adminlte::page')

@section('title', 'Índice')

@section('content_header')
    <h1>Detalles del Elemento</h1>
@stop

@section('content')
    <table border="1" class="text-center table table-bordered table-striped table-hover">
        <thead>
            <tr class="text-sm">
                <th>Nombre</th>
                <th>Fecha de nacimiento</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Admisión</th>
                <th>Grado militar</th>
                <th>Ubicación</th>
                <th>Unidad</th>
                <th>Estado de servicio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $elemento->name }}</td>
                <td>{{ $elemento->birthdate }}</td>
                <td>{{ $elemento->cellphone }}</td>
                <td>{{ $elemento->address }}</td>
                <td>{{ $elemento->admission }}</td>
                <td>{{ $elemento->militarygrade }}</td>
                <td>{{ $elemento->location }}</td>
                <td>{{ $elemento->unit }}</td>
                @if ($elemento->servicestate == 'Activo')
                    <td class="text-success">{{ $elemento->servicestate }}</td>
                @elseif($elemento->servicestate == 'Suspendido')
                    <td class="text-warning">{{ $elemento->servicestate }}</td>
                @elseif($elemento->servicestate == 'Evaluación')
                    <td class="text-primary">{{ $elemento->servicestate }}</td>
                @else
                    <td class="text-danger">{{ $elemento->servicestate }}</td>
                @endif
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <a href="{{ route('elementosMilitares.index') }}">
            <button class="btn btn-sm btn-primary mt-2 mr-2">
                <i class="fas fa-angle-double-left"></i> Regresar al índice
            </button>
        </a>
    </div>
@stop
