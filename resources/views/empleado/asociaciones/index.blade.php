@extends('adminlte::page')

@section('title', 'Asociaciones')

@section('content_header')
    <h1>Listado de empleados y clientes asociados</h1>
@stop

@section('content')
    @foreach ($users as $user)
        {{-- Se verifica si el usuario de tipo empleado tiene clientes asociados --}}
        @if (!$user->clientes->isEmpty())
            <table border="1" class="text-center table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Clientes del empleado {{ $user->name }}</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Se usa forelse para manehar bucles vacíos --}}
                    @foreach ($user->clientes as $cliente)
                        @if ($cliente->nombrecliente)
                            <tr>
                                <td>
                                    {{ $cliente->nombrecliente }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('empleado.clientes.show', $cliente) }}">
                                            <button class="btn btn-sm btn-secondary mt-2 mr-2">
                                                <i class="far fa-eye"></i> Detalles
                                            </button>
                                        </a>
                                        <a href="{{ route('empleado.asociaciones.edit', $cliente) }}">
                                            <button class="btn btn-sm btn-primary mt-2 mr-2">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                        </a>
                                        <form action="{{ route('empleado.asociaciones.destroy', $cliente) }}" method="post"
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
    <div class="text-center">
        <a href="{{ route('empleado.asociaciones.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Agregar nueva asociación
        </a>
    </div>
@stop
