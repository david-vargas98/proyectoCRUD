<div>
    @if ($userActions->count())
        <div class="card-header">
            <div class="input-group">
                <input wire:model="search" wire:keydown.enter="$refresh" class="form-control"
                    placeholder="Ingrese el usuario, acción, tabla o ID afectado">
                <div class="input-group-append">
                    <button class="btn btn-primary" wire:click="$refresh">Buscar</button>
                    <button class="btn btn-secondary" wire:click="clearSearch">Limpiar</button>
                </div>
            </div>
        </div>

        <table border="1" class="text-center table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-sm">
                    <th>Usuario responsable</th>
                    <th>Acción realizada</th>
                    <th>Tabla</th>
                    <th>ID de registro afectado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userActions as $action)
                    <tr>
                        <td>{{ $action->user->name }}</td>
                        @if ($action->action == 'Crear')
                            <td class="text-success">{{ $action->action }}</td>
                        @elseif($action->action == 'Editar' || $action->action == 'Editar roles')
                            <td class="text-primary">{{ $action->action }}</td>
                        @elseif($action->action == 'Borrar' || $action->action == 'Quitar Todos los Roles')
                            <td class="text-danger">{{ $action->action }}</td>
                        @elseif($action->action == 'Desbloqueo')
                            <td class="text-warning">{{ $action->action }}</td>
                        @endif
                        <td>{{ $action->table_name }}</td>
                        <td>{{ $action->record_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $userActions->links() }}
        </div>
    @else
        <div class="card-body">
            <p class="alert alert-info">No hay registros</p>
        </div>
    @endif
</div>
