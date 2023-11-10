@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Lista de clientes</h1>
@stop

@section('content')
    {{-- Mensaje de confirmación --}}
    @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
    @endif
    @if ($clientes->isEmpty())
        <div class="alert alert-info">No hay clientes registrados.</div>
    @else
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td class="text-sm">{{ $cliente->id }}</td>
                        <td class="text-sm">{{ $cliente->nombrecliente }}</td>
                        <td class="text-sm">{{ $cliente->apellidopat }}</td>
                        <td class="text-sm">{{ $cliente->apellidomat }}</td>
                        <td class="text-sm">{{ $cliente->fechanacimiento }}</td>
                        <td class="text-sm">{{ $cliente->correo }}</td>
                        <td class="text-sm">{{ $cliente->telefono }}</td>
                        <td class="text-sm">{{ $cliente->direccion }}</td>
                        <td class="text-sm">{{ $cliente->ciudad }}</td>
                        <td class="text-sm">{{ $cliente->estado }}</td>
                        <td class="text-sm">{{ $cliente->pais }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('empleado.clientes.show', $cliente) }}">
                                    <button class="btn btn-sm btn-secondary mt-2 mr-2">
                                        <i class="far fa-eye"></i> Detalles
                                    </button>
                                </a>
                                <a href="{{ route('empleado.clientes.edit', $cliente) }}">
                                    <button class="btn btn-sm btn-primary mt-2 mr-2">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </a>
                                <form action="{{ route('empleado.clientes.destroy', $cliente) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mt-2 mr-2">
                                        <i class="fa fa-trash"></i> Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div class="text-center">
        <a href="{{ route('empleado.clientes.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Agregar nuevo cliente
        </a>
    </div>
@stop

@section('js')
    <script>
        // Función para ocultar el mensaje después de 5 segundos (5000 milisegundos)
        //Esta función se usa para ejecutar una acción después de un cierto tiempo
        setTimeout(function() { //Función anónima, no tiene un nombre, se declara y se ejecuta al mismo tiempo.
            //Esto selecciona un elemento HTML usando su id, le pasamos el del mensaje y se pone none (sin mostrar)
            //Y se le dice que espero 5 seg antes de ejecutar lo anterior
            document.getElementById('successMessage').style.display = 'none';
        }, 5000);
    </script>
@stop
