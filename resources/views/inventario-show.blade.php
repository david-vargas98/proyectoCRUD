@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Detalles del inventario</title>
    </head>
    <body>
        {{-- Encabezado --}}
        <h1>Detalles del Inventario</h1>
        {{-- Se muestra la propiedad ID del inventario, accediendo a esta mediante "->" del objeto $inventario  --}}
        <p>ID: {{ $inventario->id }}</p>
        {{-- Se muestra la propiedad descripción, accediendo a esta mediante "->" del objeto $inventario --}}
        <p>Descripción: {{ $inventario->descripcion }}</p>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop