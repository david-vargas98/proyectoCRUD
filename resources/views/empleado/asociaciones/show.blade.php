@extends('adminlte::page')

@section('title', 'Asociaciones')

@section('content_header')
    <h1>Listado de empleados y clientes asociados</h1>
@stop

@section('content')
    @if ($asociacion)
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Empleado</th>
                    <th>Proyecto</th>
                    <th>Presupuesto</th>
                    <th>estado</th>
                    <th>Inicio</th>
                    <th>Visualizar contrato</th>
                    <th>Descargar contrato</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $asociacion->cliente->nombrecliente }}
                    </td>
                    <td>
                        {{ $asociacion->user->name }}
                    </td>
                    <td>
                        {{ $asociacion->proyecto }}
                    </td>
                    <td>
                        {{ $asociacion->presupuesto }}
                    </td>
                    <td>
                        {{ $asociacion->estado }}
                    </td>
                    <td>
                        {{ $asociacion->created_at }}
                    </td>
                    @if ($asociacion->contrato_ubicacion != null)
                        <td>
                            <a class="btn btn-sm btn-info mt-2 mr-2"
                                href="{{ route('empleado.asociaciones.ver', $asociacion) }}">
                                <i class="far fa-eye"></i> Vizualizar archivo
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success mt-2 mr-2"
                                href="{{ route('empleado.asociaciones.descarga', $asociacion) }}">
                                <i class="fas fa-file-download"></i> Descargar archivo
                            </a>
                        </td>
                    @else
                        <td colspan="2" class="text-danger">No existe un contrato actualmente</td>
                    @endif
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{route('empleado.asociaciones.index')}}" class="btn btn-sm btn-primary">
                <i class="fas fa-angle-double-left"></i> Regresar al índice
            </a>
        </div>
    @endif
@stop
