@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>Editar</h1>
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
        <h1 class="text-center">Edición de inventarios</h1>
        {{-- A diferencia del create, debe apuntar a: {{route(inventario.update)}} --}}
        <form action="{{ route('inventario.update', $inventario) }}" method="POST">
            @csrf
            {{-- Se debe poner la modificación de el método de envío a put|patch --}}
            @method('put') {{-- O patch --}}
            <div style="display: flex; align-items: center;justify-content: center; flex-direction: column;"> 
                <label for="descripcion" style="margin-right: 10px; font-size:28px">Descripción del inventario:</label>
                {{-- Campo de entrada --}} {{-- Se agrega el value para mostrar el valor del inventario --}}
                <input type="text" name="descripcion" placeholder="Descripción" value="{{$inventario->descripcion}}" required class="input-group-text" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-warning">Editar descripción</button>
                {{-- Validación: permite acceder al mensaje de error específico asociado con el campo 'descripcion' si hay un error de  validación. --}}
                @error('descripcion')
                    <div class="alert alert-danger mt-3" id="validacion">{{ $message }}</div>
                @enderror
            </div>
        </form>
        {{-- Se agrega imagen --}}
        <div class="d-flex justify-content-start">
            <img src="{{asset('img/gatito_2.png')}}" alt="gatito_2.png" style="max-width: 307px; margin-left: -15px;">
        </div>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //Ocultar el mensaje:
        setTimeout(function(){
        document.getElementById('validacion').style.display = 'none';
    }, 5000);
    </script>
@stop