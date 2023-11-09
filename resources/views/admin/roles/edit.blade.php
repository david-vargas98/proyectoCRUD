@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Editar rol</h1>
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
            <form action="{{route('admin.roles.update', $role)}}" method="POST">
                @method('PUT')
                @include('admin.roles.partials.form')
                <button class="btn btn-primary">Editar rol</button>
            </form>
        </div>
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