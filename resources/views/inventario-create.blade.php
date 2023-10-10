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
        <h1 class="text-center">Creación de inventarios</h1>
        {{-- En vez de /inventario se puede usar: {{route(inventario.store)}} --}}
        <form action="{{ route('inventario.store') }}" method="POST">
            @csrf
            <div style="display: flex; align-items: center;justify-content: center; flex-direction: column;">
                <label for="descripcion" style="font-size:28px">Descripción del inventario:</label>
                {{-- Campo de entrada --}}
                <input type="text" name="descripcion" placeholder="Descripción" required class="input-group-text" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-dark">Agregar nuevo inventario</button>
                {{-- Validación: permite acceder al mensaje de error específico asociado con el campo 'descripcion' si hay un error de  validación. --}}
                @error('descripcion')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
        </form>
        <div class="d-flex justify-content-center">
            <img src="{{asset('img/gatito.png')}}" alt="gatito.png" style="max-width: 480px;">
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