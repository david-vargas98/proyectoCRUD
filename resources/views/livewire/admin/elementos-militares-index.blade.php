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
                placeholder="Ingrese el nombre del elemento">
            <div class="input-group-append">
                <button class="btn btn-primary" wire:click="$refresh">Buscar</button>
                <button class="btn btn-secondary" wire:click="clearSearch">Limpiar</button>
            </div>
        </div>
    </div>

    @if ($elementos->count())
        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elementos as $elemento)
                    <tr>
                        <td class="text-sm">{{ $elemento->name }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('elementosMilitares.show', $elemento) }}">
                                    <button class="btn btn-sm btn-secondary mt-2 mr-2">
                                        <i class="far fa-eye"></i>Detalles
                                    </button>
                                </a>
                                <a href="{{ route('elementosMilitares.edit', $elemento) }}">
                                    <button class="btn btn-sm btn-primary mt-2 mr-2">
                                        <i class="fas fa-edit"></i>Editar
                                    </button>
                                </a>
                                <form action="{{ route('elementosMilitares.destroy', $elemento) }}" method="post"
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
        <div class="mt-2">
            {{ $elementos->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
    @endif
    <div class="text-center">
        <a href="{{ route('elementosMilitares.create') }}">
            <button class="btn btn-sm btn-success mt-2 mr-2">
                <i class="fa fa-plus"></i> Agregar elemento nuevo
            </button>
        </a>
    </div>
</div>
