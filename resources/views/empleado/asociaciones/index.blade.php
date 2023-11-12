@extends('adminlte::page')

@section('title', 'Asociaciones')

@section('content_header')
    <h1>Listado de empleados y clientes asociados</h1>
@stop

@section('content')
    {{-- Se verifica si el usuario de tipo empleado tiene clientes asociados --}}
    @if (!$asociaciones->isEmpty())
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Empleado</th>
                    <th>Inicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asociaciones as $asociacion)
                    <tr>
                        <td>
                            {{ $asociacion->cliente->nombrecliente }}
                        </td>
                        <td>
                            {{ $asociacion->user->name }}
                        </td>
                        <td>
                            {{ $asociacion->created_at }}
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('empleado.asociaciones.edit', $asociacion) }}">
                                    <button class="btn btn-sm btn-primary mt-2 mr-2">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </a>
                                <form action="{{ route('empleado.asociaciones.destroy', $asociacion) }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mt-2 mr-2">
                                        <i class="fa fa-trash"></i> Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No hay asociaciones registradas.</div>
    @endif
    <div class="text-center">
        <a href="{{ route('empleado.asociaciones.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Agregar nueva asociación
        </a>
    </div>
@stop
