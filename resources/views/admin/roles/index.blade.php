@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Lista de roles</h1>
@stop

@section('content')
    @if ($roles->count())
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th colspan="2"></th> {{-- El colspan es para ocupar 2 columnas --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td class="text-right d-flex justify-content-end">
                                    <a href="{{ route('admin.roles.edit', $role) }}">
                                        <button class="btn btn-sm btn-primary mt-2 mr-2">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </a>
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="formulario-eliminar">
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
    @else
        <div class="card-body">
            <p class="alert alert-info">No hay registros</p>
        </div>
    @endif
    <div class="text-center">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Crear rol
        </a>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success') == 'El rol se eliminó con éxito')
        <script>
            Swal.fire({
                title: "!Es un hecho!",
                text: "El rol fue borrado con éxito.",
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
                title: "¿Estás seguro?",
                text: "El rol va a ser borrado",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Borrar"
            }).then((result) => {
                if (result.isConfirmed) {
                    //Se envía el formulario si es true, y se envía con submit para borrar el registro
                    this.submit();
                }
            });
        });
    </script>
@stop
