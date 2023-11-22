<div>
    {{-- Mensaje de confirmación --}}
    @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-header">
        <div class="input-group">
            <input wire:model="search" wire:keydown.enter="$refresh" class="form-control"
                placeholder="Ingrese el nombre del paciente o psicólogo">
            <div class="input-group-append">
                <button class="btn btn-primary" wire:click="$refresh">Buscar</button>
                <button class="btn btn-secondary" wire:click="clearSearch">Limpiar</button>
            </div>
        </div>
    </div>
    @if ($pacientes->count())
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
                    <th>Paciente</th>
                    <th>Trastorno</th>
                    <th>Severidad</th>
                    <th>Psicólogo asignado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td class="text-sm">{{ $paciente->militaryElement->name }}</td>
                        <td class="text-sm">{{ $paciente->disorder }}</td>
                        <td class="text-sm">{{ $paciente->severity }}</td>
                        @if ($paciente->user_id == null)
                            <td class="text-sm"><span class="text-info">No asignado</span></td>
                        @else
                            <td class="text-sm">{{ $paciente->userPsicologo->name }}</td>
                        @endif
                        <td>
                            @if ($paciente->militaryElement->trashed())
                                <span class="text-danger"> (Elemento borrado)</span>
                            @else
                                <div class="btn-group" role="group">
                                    <a href="{{ route('pacientes.show', $paciente) }}">
                                        <button class="btn btn-sm btn-secondary mt-2 mr-2">
                                            <i class="fas fa-walking"></i> Actividades
                                        </button>
                                    </a>
                                    <a href="{{ route('pacientes.edit', $paciente) }}">
                                        <button class="btn btn-sm btn-primary mt-2 mr-2">
                                            <i class="fas fa-edit"></i> Editar
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
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $pacientes->links() }}
        </div>
        <div class="text-center">
            <a href="{{ route('pacientes.create') }}">
                <button class="btn btn-sm btn-success mt-2 mr-2">
                    <i class="fa fa-plus"></i> Agregar paciente
                </button>
            </a>
        </div>
    @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
    @endif

</div>
