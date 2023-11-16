@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>Editar elemento militar</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('elementosMilitares.update', $elemento) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del elemento"
                        pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="60" value="{{ $elemento->name }}"
                        required>
                    @error('name')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="birthdate">Fecha de nacimiento</label>
                    <input type="date" name="birthdate" class="form-control" value="{{ $elemento->birthdate }}" required>
                    @error('birthdate')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="cellphone">Teléfono</label>
                    <input type="text" name="cellphone" class="form-control"
                        placeholder="Ingrese el teléfono del elemento" pattern="\d{10}" minlength="10" maxlength="10"
                        value="{{ $elemento->cellphone }}" required>
                    @error('cellphone')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control"
                        placeholder="Ingrese la dirección del elemento" maxlength="70" value="{{ $elemento->address }}"
                        required>
                    @error('address')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="admission">Fecha de admisión</label>
                    <input type="date" name="admission" class="form-control" value="{{ $elemento->admission }}" required>
                    @error('admission')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="militarygrade">Grado militar</label>
                    <input type="text" name="militarygrade" class="form-control"
                        placeholder="Ingrese el grado del elemento" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1"
                        maxlength="20" value="{{ $elemento->militarygrade }}" required>
                    @error('militarygrade')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="location">Ubicación</label>
                    <input type="text" name="location" class="form-control"
                        placeholder="Ingrese la ubicación actual del elemento" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+"
                        minlength="1" maxlength="20" value="{{ $elemento->location }}" required>
                    @error('location')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="unit">Unidad</label>
                    <input type="unit" name="unit" class="form-control"
                        placeholder="Ingrese la unidad a la que pertenece el elemento" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+"
                        minlength="1" maxlength="20" value="{{ $elemento->unit }}" required>
                    @error('unit')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="servicestate">Estado del servicio</label>
                    <select name="servicestate" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione un estado de servicio</option>
                        <option value="Activo" @if ($elemento->servicestate == 'Activo') selected @endif>Activo</option>
                        <option value="Activo" @if ($elemento->servicestate == 'Suspendido') selected @endif>Suspendido</option>
                        <option value="Activo" @if ($elemento->servicestate == 'Evaluación') selected @endif>Evaluación</option>
                        <option value="Activo" @if ($elemento->servicestate == 'Terminado') selected @endif>Terminado</option>
                    </select>
                    @error('servicestate')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Actualizar elemento
                    </button>
                    <a href="{{ route('elementosMilitares.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-angle-double-left"></i> Regresar al índice
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
