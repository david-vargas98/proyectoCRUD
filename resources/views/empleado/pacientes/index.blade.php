@extends('adminlte::page')

@section('title', 'Índice')

@section('content_header')
    <h1>Pacientes</h1>
@stop

@section('content')
    <table border="1" class="text-center table table-bordered table-striped table-hover">
        <thead>
            <tr class="text-sm">
                <th>Paciente</th>
                <th>Trastorno</th>
                <th>Severidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td class="text-sm">{{ $paciente->militaryElement->name }}</td>
                    <td class="text-sm">{{ $paciente->disorder }}</td>
                    <td class="text-sm">{{ $paciente->severity }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('pacientes.show', $paciente) }}">
                                <button class="btn btn-sm btn-secondary mt-2 mr-2">
                                    <i class="far fa-eye"></i>Detalles
                                </button>
                            </a>
                            <a href="{{ route('pacientes.edit', $paciente) }}">
                                <button class="btn btn-sm btn-primary mt-2 mr-2">
                                    <i class="fas fa-edit"></i>Editar
                                </button>
                            </a>
                            <form action="{{ route('pacientes.destroy', $paciente) }}" method="post"
                                style="display: inline;" class="formulario-eliminar">
                                {{-- Se usa para prevenir inyecciones de sql fuera del sistema local, es un token para confirmar que somos nosotros     --}}
                                @csrf
                                {{-- También se debe cambiar como el patch para que se identifique en el route --}}
                                @method('DELETE')
                                {{-- Botón para accionar la eliminación --}}
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
    {{-- <div class="mt-2">
        {{ $paciente->links() }}
    </div> --}}
    <div class="text-center">
        <a href="{{ route('pacientes.create') }}">
            <button class="btn btn-sm btn-success mt-2 mr-2">
                <i class="fa fa-plus"></i> Agregar paciente
            </button>
        </a>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success') == 'El paciente fue borrado con éxito')
        <script>
            Swal.fire({
                title: "!Es un hecho!",
                text: "El paciente fue borrado con éxito.",
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
                text: "Esta es una acción definitiva D:",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borrar"
            }).then((result) => {
                if (result.isConfirmed) {
                    //Se envía el formulario si es true, y se envía con submit para borrar el registro
                    this.submit();
                }
            });
        });
    </script>
@stop
