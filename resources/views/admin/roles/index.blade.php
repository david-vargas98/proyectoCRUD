@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Lista de roles</h1>
@stop

@section('content')
    {{-- Mensaje de confirmación --}}
    @if (session('success'))
    <div class="alert alert-success" id="successMessage">
        {{session('success')}}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th colspan="2"></th> {{-- El colspan es para ocupar 2 columnas--}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td class="text-right d-flex justify-content-end">
                                <a href="{{route('admin.roles.edit', $role)}}">
                                    <button class="btn btn-sm btn-primary mt-2 mr-2">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </a>
                                <form action="{{route('admin.roles.destroy', $role)}}" method="POST">
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
    <div class="text-center">
        <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Crear rol
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