@extends('adminlte::page')

@section('title', 'Asociaciones')

@section('content_header')
    <h1>Nueva asociación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Se agrega enctype="multipart/form-data" para la carga de archivos. Esto es necesario porque el valor predeterminado de enctype es "application/x-www-form-urlencoded", que no admite la carga de archivos--}}
            <form action="{{ route('empleado.asociaciones.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user_id">Empleado</label>
                    <select name="user_id" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Selecciona un empleado</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Selecciona un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">
                                {{ $cliente->nombrecliente }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="proyecto">Proyecto</label>
                    <input type="text" name="proyecto" class="form-control" placeholder="Ingrese el nombre del proyecto"
                        style="width: 300px;" minlength="1" maxlength="20" required>
                    @error('proyecto')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="presupuesto">Presupuesto</label>
                    <input type="text" name="presupuesto" class="form-control"
                        placeholder="Ingrese el presupuesto del proyecto" style="width: 300px;" pattern="\d*" inputmode="numeric" required>
                    @error('presupuesto')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="estado">Estado</label>
                    <select name="estado" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione un estado</option>
                        <option value="Iniciado">Iniciado</option>
                        <option value="Activo">Activo</option>
                        <option value="Suspendido">Suspendido</option>
                        <option value="Cancelado">Cancelado</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                    @error('estado')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="contrato">Contrato</label>
                    <input type="file" name="contrato">
                    @error('contrato')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i> Crear nueva asociación
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
