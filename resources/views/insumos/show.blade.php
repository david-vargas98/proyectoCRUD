@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1>Detalles</h1>
@stop

@section('content')
    {{-- Se muestra la propiedad ID del inventario, accediendo a esta mediante "->" del objeto $inventario  --}}
    <p>ID: {{ $insumo->id }}</p>
    {{-- Se muestra la propiedad descripción, accediendo a esta mediante "->" del objeto $inventario --}}
    <p>Descripción: {{ $insumo->insumodescripcion }}</p>
    <p>Cantidad: {{ $insumo->insumocantidad }}</p>
    {{-- Se muestra a que inventario pertenece --}}
    <p>Perteneciente al inventario: {{$insumo->inventario->descripcion}}</p>
    <div>
        <a href="{{route('insumo.index')}}">
            <button class="btn btn-sm btn-primary mt-2 mr-2">
                <i class="fas fa-backward"></i> Regresar al índice
            </button>
        </a>
    </div>
    {{-- Se agrega imagen --}}
    <div class="d-flex justify-content-around">
        <img src="{{asset('img/chems.png')}}" alt="chems.png" class="float-right" style="margin-top: -200px; margin-left: 200px;">
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop