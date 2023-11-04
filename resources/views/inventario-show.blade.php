@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1>Detalles</h1>
@stop

@section('content')
    {{-- Se muestra la propiedad ID del inventario, accediendo a esta mediante "->" del objeto$inventario  --}}
    <p>ID: {{ $inventario->id }}</p>
    {{-- Se muestra la propiedad descripción, accediendo a esta mediante "->" del objeto$inventario --}}
    <p>Descripción: {{ $inventario->descripcion }}</p>
    {{-- Se muestra el usuario que creó el inventario --}}
    <p>Creado por: {{$inventario->user->name}}</p>
    <a href="{{route('inventario.index')}}">
        <button class="btn btn-sm btn-primary mt-2 mr-2">
            <i class="fas fa-backward"></i> Regresar al índice
        </button>
    </a>
    {{-- Se agrega imagen --}}
    <div class="d-flex justify-content-around">
        <img src="{{asset('img/chems.png')}}" alt="chems.png" class="float-right"style="margin-top: -200px; margin-left: 200px;">
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop