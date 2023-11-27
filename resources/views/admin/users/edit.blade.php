@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Asignación de roles y bloqueos</h1>
@stop

@section('content')
    {{-- Mensaje de confirmación --}}
    @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{ $user->name }}</p>

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
            @error('roles')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
            @if (!$user->roles->isEmpty())
                <form action="{{ route('admin.users.removeAllRoles', $user) }}" method="POST" class="formulario-eliminar">
                    @csrf
                    @method('PUT')
                    <!-- Botón para quitar todos los roles -->
                    <button type="submit" class="btn btn-danger mt-2" onclick="removeAllRoles()">Quitar Todos los
                        Roles</button>
                </form>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="h5">Bloqueo</p>
            @if ($user->attempts >= 3)
                <label class="h6 text-danger">El usuario se encuentra bloquado</label>
                <form action="{{ route('admin.users.desbloqueo', $user) }}" method="POST" class="formulario-bloqueo">
                    @method('PUT')
                    @csrf
                    <!-- Botón de enviar el formulario -->
                    <button type="submit" class="btn btn-primary mt-2">Desbloquear</button>
                </form>
            @else
                <label class="h6">El usuario no se encuentra bloqueado</label>
            @endif
        </div>
    </div>
    <div class="text-center">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-angle-double-left"></i> Regresar al índice
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('roles') == 'Se quitaron todos los roles correctamente')
        <script>
            Swal.fire({
                title: "!Es un hecho!",
                text: "Se quitaron todos los roles con éxito.",
                icon: "success"
            });
        </script>
    @endif
    @if (session('desbloqueo') == 'El usuario fue desbloqueado correctamente')
        <script>
            Swal.fire({
                title: "!Es un hecho!",
                text: "El usuario fue desbloqueado con éxito.",
                icon: "success"
            });
        </script>
    @endif
    {{-- Script que lleva acabo la pregunta de confirmación --}}
    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault(); //Se detiene el envío del formulario
            //En su lugar, saldrá la alerta
            Swal.fire({
                title: "Cuidado",
                text: "¿Estás seguro de que quieres quitar todos los roles?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Quitar roles"
            }).then((result) => {
                if (result.isConfirmed) {
                    //Se envía el formulario si es true, y se envía con submit para borrar el registro
                    this.submit();
                }
            });
        });
    </script>
    {{-- Para el bloqueo --}}
    <script>
        $('.formulario-bloqueo').submit(function(e) {
            e.preventDefault(); //Se detiene el envío del formulario
            //En su lugar, saldrá la alerta
            Swal.fire({
                title: "Cuidado",
                text: "¿Estás seguro de que quieres Desbloquear al usuario?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Desbloquear"
            }).then((result) => {
                if (result.isConfirmed) {
                    //Se envía el formulario si es true, y se envía con submit para borrar el registro
                    this.submit();
                }
            });
        });
    </script>
@stop
