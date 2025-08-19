@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Editar el cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('empleado.clientes.update', $cliente)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombrecliente">Nombre</label>
                    <input type="text" name="nombrecliente" class="form-control" placeholder="Ingrese el nombre del cliente" value="{{$cliente->nombrecliente}}" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('nombrecliente')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="apellidopat">Apellido Paterno</label>
                    <input type="text" name="apellidopat" class="form-control" placeholder="Ingrese el apellido paterno del cliente" value="{{$cliente->apellidopat}}" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('apellidopat')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="apellidomat">Apellido materno</label>
                    <input type="text" name="apellidomat" class="form-control" placeholder="Ingrese el apellido materno del cliente" value="{{$cliente->apellidomat}}" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('apellidomat')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="fechanacimiento">Fecha de nacimiento</label>
                    <input type="date" name="fechanacimiento" class="form-control" value="{{$cliente->fechanacimiento}}" required>
                    @error('fechanacimiento')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="correo">Correo electrónico</label>
                    <input type="text" name="correo" class="form-control" placeholder="Ingrese el correo electrónico del cliente" value="{{$cliente->correo}}" minlength="6" maxlength="50" required>
                    @error('correo')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono del cliente" value="{{$cliente->telefono}}" pattern="\d{10}" minlength="10" maxlength="12" required>
                    @error('telefono')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección del cliente" value="{{$cliente->direccion}}"maxlength="70" required>
                    @error('direccion')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" class="form-control" placeholder="Ingrese la ciudad de origen del cliente" value="{{$cliente->ciudad}}" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('ciudad')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" class="form-control" placeholder="Ingrese el estado del cual proviene el cliente" value="{{$cliente->estado}}" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('estado')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <label for="pais">País</label>
                    <input type="text" name="pais" class="form-control" placeholder="Ingrese el país del cliente"  value="{{$cliente->pais}}" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" maxlength="20" required>
                    @error('pais')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Actualizar información de cliente</button>
            </form>
        </div>
    </div>
@stop