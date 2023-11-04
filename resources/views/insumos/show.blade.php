@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1>Detalles</h1>
@stop

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        {{-- Se muestra la propiedad ID del inventario, accediendo a esta mediante "->" del objeto $inventario  --}}
        <p>ID: {{ $insumo->id }}</p>
        {{-- Se muestra la propiedad descripción, accediendo a esta mediante "->" del objeto $inventario --}}
        <p>Descripción: {{ $insumo->insumodescripcion }}</p>
        <p>Cantidad: {{ $insumo->insumocantidad }}</p>
        {{-- Se muestra a que inventario pertenece --}}
        <p>Perteneciente al inventario: {{$insumo->inventario->descripcion}}</p>
        {{-- Se agrega imagen --}}
        <div class="d-flex justify-content-around">
            <img src="{{asset('img/chems.png')}}" alt="chems.png" class="float-right" style="margin-top: -200px; margin-left: 200px;">
        </div>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop