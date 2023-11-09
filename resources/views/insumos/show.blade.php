@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1>Detalles del insumo</h1>
@stop

@section('content')
    <table border="1" class="text-center table table-bordered table-striped table-hover">
        <thead>
            <tr class="text-sm">
                <th>ID</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Inventario</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-sm">{{$insumo->id}}</td>
                <td class="text-sm">{{$insumo->insumodescripcion}}</td>
                <td class="text-sm">{{$insumo->insumocantidad}}</td>
                <td class="text-sm">{{$insumo->inventario->descripcion}}</td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <a href="{{route('insumo.index')}}">
            <button class="btn btn-sm btn-primary mt-2 mr-2">
                <i class="fas fa-backward"></i> Regresar al índice
            </button>
        </a>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop