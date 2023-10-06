@extends('adminlte::page')

@section('title', 'Índice')

@section('content_header')
    <h1>Inventarios</h1>
@stop

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Índice de inventarios</title>
    </head>
    <body>
        <h1>Índice de inventarios</h1>
        <!-- Se realiza iteraciones en una lista no ordenada -->
        <ul>
            <!-- Se retoma la variable que se usó en 'compact' -->
            @foreach ($inventarios as $inventario)
                <li>
                    {{-- Se agrega un enlace para que en el index se pueda acceder a la vista de cada inventario --}}
                    <a href="{{route('inventario.show', $inventario)}}">
                        {{$inventario->descripcion}}
                    </a>
                    |
                    <a href="{{route('inventario.edit', $inventario)}}">
                        Editar
                    </a>
                    |
                    <form action="{{route('inventario.destroy', $inventario)}}" method="post">
                        {{-- Se usa para prevenir inyecciones de sql fuera del sistema local, es un token para confirmar que somos nosotros     --}}
                        @csrf
                        {{-- También se debe cambiar como el patch para que se identifique en el route --}}
                        @method('DELETE')
                        {{-- Botón para accionar la eliminación --}}
                        <input type="submit" value="Borrar">
                    </form>
                </li>
            @endforeach
        </ul>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
