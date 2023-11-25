<div>
    <div class="card">

        <div class="card-header">
            <div class="input-group">
                <input wire:model="search" wire:keydown.enter="$refresh" class="form-control"
                    placeholder="Ingrese el nombre o correo del usuario">
                <div class="input-group-append">
                    <button class="btn btn-primary" wire:click="$refresh">Buscar</button>
                    <button class="btn btn-secondary" wire:click="clearSearch">Limpiar</button>
                </div>
            </div>
        </div>

        @if ($users->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.users.edit', $user) }}">
                                        <button class="btn btn-sm btn-primary mt-2 mr-2">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <p class="alert alert-info">No hay registros</p>
            </div>
        @endif
    </div>
</div>
