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
        <div class="text-center">
            <h1>Índice de inventarios</h1>
        </div>
        
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
            <table border="1" class="text-center table table-bordered table-striped table-hover">
                <thead>
                    <tr class="text-sm">
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventarios as $inventario)
                        <tr>
                            <td class="text-sm">{{$inventario->descripcion}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{route('inventario.show', $inventario)}}">
                                        <button class="btn btn-secondary">
                                            <i class="far fa-eye"></i>Detalles
                                        </button>
                                    </a>
                                    <a href="{{route('inventario.edit', $inventario)}}">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-edit"></i>Editar
                                        </button>
                                    </a>
                                    <form action="{{route('inventario.destroy', $inventario)}}" method="post" style="display: inline;">
                                        {{-- Se usa para prevenir inyecciones de sql fuera del sistema local, es un token para confirmar que somos nosotros     --}}
                                        @csrf
                                        {{-- También se debe cambiar como el patch para que se identifique en el route --}}
                                        @method('DELETE')
                                        {{-- Botón para accionar la eliminación --}}
                                        <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fa fa-trash"></i> Borrar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{$inventarios->links()}}
            </div>
        <div class="text-center">
            <a href="{{route('inventario.create')}}">
                <div class="btn btn-success">Crear nuevo inventario</div>
            </a>
        </div>
        @if ($inventarios->isEmpty())
            <div style="flex: 1; margin-top: 80px; margin-left: 40px">
                <img src="{{asset('img/perrito.png')}}" alt="perrito.png">
            </div>
            <h3 class="text-center" style="margin-top: 40px">Nada por aquí...</h3>
        @endif

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
