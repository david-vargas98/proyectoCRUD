@extends('adminlte::page')

@section('title', 'Asociaciones')

@section('content_header')
    <h1>Editar asociación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('empleado.asociaciones.update', $asociacion) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="user_id">Empleado</label>
                    <select name="user_id" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Selecciona un empleado</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $asociacion->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Selecciona un cliente
                        </option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}"
                                {{ $asociacion->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombrecliente }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="proyecto">Proyecto</label>
                    <input type="text" name="proyecto" class="form-control" value="{{ $asociacion->proyecto }}"
                        placeholder="Ingrese el nombre del proyecto" style="width: 300px;" minlength="1" maxlength="20"
                        required>
                    @error('proyecto')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="presupuesto">Presupuesto</label>
                    <input type="text" name="presupuesto" class="form-control" value="{{ $asociacion->presupuesto }}"
                        placeholder="Ingrese el presupuesto del proyecto" style="width: 300px;" pattern="\d*"
                        inputmode="numeric" required>
                    @error('presupuesto')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="estado">Estado</label>
                    <select name="estado" class="form-control" style="width: 250px;" required>
                        <option value="" disabled>Seleccione un estado</option>
                        <option value="Iniciado" {{ $asociacion->estado == 'Iniciado' ? 'selected' : '' }}>Iniciado
                        </option>
                        <option value="Activo" {{ $asociacion->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Suspendido" {{ $asociacion->estado == 'Suspendido' ? 'selected' : '' }}>Suspendido
                        </option>
                        <option value="Cancelado" {{ $asociacion->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado
                        </option>
                        <option value="Terminado" {{ $asociacion->estado == 'Terminado' ? 'selected' : '' }}>Terminado
                        </option>
                    </select>
                    @error('estado')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="contrato">Contrato</label>
                    @if ($asociacion->contrato_nombre)
                        <p>Contrato actual: {{ $asociacion->contrato_nombre }}</p>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="quitar_contrato" value="0">
                            <input type="checkbox" name="quitar_contrato">
                            <label for="quitar_contrato"></label> Quitar contrato actual
                        </div>
                    @endif
                    <br>
                    <p>Quitar y reemplazar por otro:</p>
                    <input type="file" name="contrato">
                    @error('contrato')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar asociación
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
