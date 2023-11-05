@extends('adminlte::page')

@section('title', 'Insumos')

@section('content_header')
    <h1>Insumos</h1>
@stop

@section('content')
<body>
    <div class="text-center">
        <h1>Índice de insumos</h1>
    </div>
    {{-- Mensaje de éxito --}}
    @if(session('success'))
    <div class="alert alert-success mt-2" id="successMessage">
        {{ session('success') }}
    </div>
    @endif
    {{-- Mensaje de modificación --}}
    @if(session('update'))
    <div class="alert alert-warning mt-2" id="updateMessage">
        {{ session('update') }}
    </div>
    @endif
    {{-- Se agrega mensaje para la eliminación --}}
    @if (Session::get('deleted'))
        <div class="alert alert-danger mt-2" id="deleteMessage">
            <strong>{{Session::get('deleted')}}</strong><br>
        </div>
    @endif
    @if ($insumos)
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
                    <th>Inventario</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insumos as $insumo)
                    <tr>
                        <td class="text-sm">{{$insumo->inventario->descripcion}}</td>
                        <td class="text-sm">{{$insumo->insumodescripcion}}</td>
                        <td class="text-sm">{{$insumo->insumocantidad}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{route('insumo.show', $insumo)}}">
                                    <button class="btn btn-sm btn-secondary mt-2 mr-2">
                                        <i class="far fa-eye"></i> Detalles
                                    </button>
                                </a>
                                <a href="{{route('insumo.edit', $insumo)}}">
                                    <button class="btn btn-sm btn-primary mt-2 mr-2">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </a>
                                <form action="{{route('insumo.destroy', $insumo)}}" method="post" style="display: inline;">
                                    {{-- Se usa para prevenir inyecciones de sql fuera del sistema local, es un token para  confirmar que somos nosotros --}}
                                    @csrf
                                    {{-- También se debe cambiar como el patch para que se identifique en el route --}}
                                    @method('DELETE')
                                    {{-- Botón para accionar la eliminación --}}
                                    <button type="submit" class="btn btn-sm btn-danger mt-2 mr-2" onclick="event.preventDefault (); this.closest('form').submit();">
                                        <i class="fa fa-trash"></i> Borrar
                                    </button>
                                </form>
                            </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$insumos->links()}}
    @endif
    
    <div class="text-center">
        <a href="{{route('insumo.create')}}">
            <button class="btn btn-sm btn-success mt-2 mr-2">
                <i class="fas fa-plus-square"></i> Agregar nuevo insumo
            </button>
        </a>
    </div>

    @if (isset($insumos) && $insumos->isEmpty())
        <div class="img-fluid d-flex justify-content-end">
            <img src="{{asset('img/perrito.png')}}" alt="perrito.png" style="margin-top: 100px;">
        </div>
        <h3 class="text-center" style="margin-top: 40px">Nada por aquí...</h3>
    @endif
</body>
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