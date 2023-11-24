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

    @if ($citas->count())
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
                    <th>Paciente</th>
                    <th>Psicólogo</th>
                    <th>Fecha de la cita</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td class="text-sm">{{ $cita->patient->militaryElement->name }}</td>
                        <td class="text-sm">{{ $cita->patient->userPsicologo->name }}</td>
                        <td class="text-sm">{{ $cita->appointment_date }}</td>
                        <td>
                            @if ($cita->patient->militaryElement->trashed() || $cita->patient->trashed())
                                <span class="text-danger"> (Paciente borrado)</span>
                            @else
                                <div class="btn-group" role="group">
                                    <a href="{{ route('citas.show', $cita) }}">
                                        <button class="btn btn-sm btn-secondary mt-2 mr-2">
                                            <i class="far fa-eye"></i>Detalles
                                        </button>
                                    </a>
                                    <a href="{{ route('citas.edit', $cita) }}">
                                        <button class="btn btn-sm btn-primary mt-2 mr-2">
                                            <i class="fas fa-edit"></i>Editar
                                        </button>
                                    </a>
                                    <form action="{{ route('citas.destroy', $cita) }}" method="post"
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
            {{ $citas->links() }}
        </div>
    @else
        <div class="card-body">
            <p class="alert alert-info">No hay registros</p>
        </div>
    @endif
    <div class="text-center">
        <a href="{{ route('citas.create') }}">
            <button class="btn btn-sm btn-success mt-2 mr-2">
                <i class="fa fa-plus"></i> Agendar cita
            </button>
        </a>
    </div>
</div>
