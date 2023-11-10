@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Lista de clientes</h1>
@stop

@section('content')
    {{-- Mensaje de confirmación --}}
    @if (session('success'))
    <div class="alert alert-success" id="successMessage">
        {{session('success')}}
    </div>
    @endif
    @if ($clientes->isEmpty())
        <div class="alert alert-info">No hay clientes registrados.</div>
    @else
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Fecha de nacimiento</th>
                            <th>Correo electrónico</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>País</th>
                            <th colspan="2"></th> {{-- El colspan es para ocupar 2 columnas--}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->id}}</td>
                                <td>{{$cliente->nombrecliente}}</td>
                                <td>{{$cliente->apellidopat}}</td>
                                <td>{{$cliente->apellidomat}}</td>
                                <td>{{$cliente->fechanacimiento}}</td>
                                <td>{{$cliente->correo}}</td>
                                <td>{{$cliente->telefono}}</td>
                                <td>{{$cliente->direccion}}</td>
                                <td>{{$cliente->ciudad}}</td>
                                <td>{{$cliente->estado}}</td>
                                <td>{{$cliente->pais}}</td>
                                <td class="text-right d-flex justify-content-end">
                                    <a href="{{route('empleado.clientes.edit', $cliente)}}">
                                        <button class="btn btn-sm btn-primary mt-2 mr-2">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </a>
                                    <form action="{{route('empleado.clientes.destroy', $cliente)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mt-2 mr-2">
                                            <i class="fa fa-trash"></i> Borrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <div class="text-center">
        <a href="{{route('empleado.clientes.create')}}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Agregar nuevo cliente
        </a>
    </div>
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
</script>
@stop