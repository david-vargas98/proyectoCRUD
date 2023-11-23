@extends('adminlte::page')

@section('title', 'Acciones')

@section('content_header')
    <h1>Acciones realizadas por usuarios</h1>
@stop

@section('content')
    @if ($userActions->count())
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
                    <th>Usuario responsable</th>
                    <th>Acción realizada</th>
                    <th>Tabla</th>
                    <th>ID de registro afectado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userActions as $action)
                    <tr>
                        <td>{{ $action->user->name }}</td>
                        @if ($action->action == 'Crear')
                            <td class="text-success">{{ $action->action }}</td>
                        @elseif($action->action == 'Editar')
                            <td class="text-primary">{{ $action->action }}</td>
                        @elseif($action->action == 'Borrar')
                            <td class="text-danger">{{ $action->action }}</td>
                        @endif
                        <td>{{ $action->table_name }}</td>
                        <td>{{ $action->record_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="alert alert-info">No hay actividades realizadas or usuarios</p>
        <div class="text-center">
            <a href="{{ route('pacientes.index') }}">
                <button class="btn btn-sm btn-primary mt-2 mr-2">
                    <i class="fas fa-backward"></i> Ir al índice de pacientes
                </button>
            </a>
        </div>
    @endif
@stop
