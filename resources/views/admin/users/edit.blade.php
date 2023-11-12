@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Asignar un rol</h1>
@stop

@section('content')
    {{-- Mensaje de confirmación --}}
    @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            <strong>{{session('success')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{$user->name}}</p>

            <h2 class="h5">Listado de roles</h2>
            {{-- Se usa laravel collective --}}
            {{-- Se le pasa la info del usuario y la info de la ruta a donde se quiere enviar --}}
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @method('PUT')
                @csrf
            
                @foreach ($roles as $role)
                    <div>
                        <label>
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="mr-1"
                                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
                <!-- Botón de enviar el formulario -->
                <button type="submit" class="btn btn-primary mt-2">Asignar rol</button>
            </form>
        </div>
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