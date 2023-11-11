@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1>Detalles del cliente</h1>
@stop

@section('content')
    @if (!$cliente->users->isEmpty())
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
                    <th>Empleado responsable</th>
                    <th>Proyecto</th>
                    <th>Presupuesto</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente->users as $user)
                    <tr>
                        <td class="text-sm">{{ $user->name }}</td>
                        <td class="text-sm">{{ $user->pivot->proyecto }}</td>
                        <td class="text-sm">{{ $user->pivot->presupuesto }}</td>
                        <td class="text-sm">{{ $user->pivot->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{ route('empleado.clientes.index') }}">
                <button class="btn btn-sm btn-primary mt-2 mr-2">
                    <i class="fas fa-backward"></i> Regresar al índice de clientes
                </button>
            </a>
            <a href="{{ route('empleado.asociaciones.index') }}">
                <button class="btn btn-sm btn-info mt-2 mr-2">
                    <i class="fas fa-backward"></i> Regresar al índice de asociaciones
                </button>
            </a>
        </div>
    @else
        <p class="alert alert-info">No hay empleados trabajando con este cliente</p>
        <div class="text-center">
            <a href="{{ route('empleado.clientes.index') }}">
                <button class="btn btn-sm btn-primary mt-2 mr-2">
                    <i class="fas fa-backward"></i> Regresar al índice de clientes
                </button>
            </a>
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
