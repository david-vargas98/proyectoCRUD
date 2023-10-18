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
    </head>
    <body>
        <h1 class="text-center">Índice de inventarios</h1>
        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensaje de modificación --}}
        @if(session('update'))
            <div class="alert alert-warning" id="updateMessage">
                {{ session('update') }}
            </div>
        @endif

        {{-- Mensaje de borrado --}}
        @if(session('delete'))
            <div class="alert alert-danger" id="deleteMessage">
                {{ session('delete') }}
            </div>
        @endif

        <!-- Se realiza iteraciones en una lista no ordenada -->
        <ul>
            <!-- Se retoma la variable que se usó en 'compact' -->
            @foreach ($inventarios as $inventario)
                <li>
                    {{$inventario->descripcion}} 
                    <br>
                    {{-- Se agrega un enlace para que en el index se pueda acceder a la vista de cada inventario --}}
                    <a href="{{route('inventario.show', $inventario)}}">
                        <div class="btn btn-default">Detalles</div>
                    </a>
                    |
                    <a href="{{route('inventario.edit', $inventario)}}">
                        <div class="btn btn-primary">Editar</div>
                    </a>
                    |
                    <form action="{{route('inventario.destroy', $inventario)}}" method="post" style="display: inline;">
                        {{-- Se usa para prevenir inyecciones de sql fuera del sistema local, es un token para confirmar que somos nosotros     --}}
                        @csrf
                        {{-- También se debe cambiar como el patch para que se identifique en el route --}}
                        @method('DELETE')
                        {{-- Botón para accionar la eliminación --}}
                        <a class="btn btn-danger" href="#" onclick="event.preventDefault(); this.closest('form').submit();">Borrar</a>
                    </form>
                </li>
            @endforeach
        </ul>
        <div class="d-flex justify-content-around">
            <img src="{{asset('img/perrito.png')}}" alt="perrito.png">
        </div>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    // Función para ocultar el mensaje después de 5 segundos (5000 milisegundos)
    //Esta función se usa para ejecutar una acción después de un cierto tiempo
    setTimeout(function(){ //Función anónima, no tiene un nombre, se declara y se ejecuta al mismo tiempo.
        //Esto selecciona un elemento HTML usando su id, le pasamos el del mensaje y se pone none (sin mostrar)
        //Y se le dice que espero 5 seg antes de ejecutar lo anterior
        document.getElementById('successMessage').style.display = 'none';
    }, 5000);

    //El de modificación:
    setTimeout(function(){
        document.getElementById('updateMessage').style.display = 'none';
    }, 5000);

    //El de borrado:
    setTimeout(function(){
        document.getElementById('deleteMessage').style.display = 'none';
    }, 5000);
</script>
@stop
