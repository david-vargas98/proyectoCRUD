@extends('adminlte::page')

@section('title', 'Crear inventario')

@section('content_header')
    <h1>Inventarios</h1>
@stop

@section('content')
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        {{-- En vez de /inventario se puede usar: {{route(inventario.store)}} --}}
        <form action="{{ route('inventario.store') }}" method="POST">
            @csrf
            <div style="display: flex; align-items: center;">
                <label for="descripcion" style="margin-right: 10px; font-size:28px">Descripción del inventario:</label>
                {{-- Campo de entrada --}}
                <input type="text" name="descripcion" placeholder="Descripción" required class="input-group-text" style="margin-right: 10px">
                <button type="submit" class="btn btn-dark">Agregar nuevo inventario</button>
                {{-- Validación: permite acceder al mensaje de error específico asociado con el campo 'descripcion' si hay un error de  validación. --}}
                @error('descripcion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop