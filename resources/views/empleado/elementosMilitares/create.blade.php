@extends('adminlte::page')

@section('title', 'Agregar')

@section('content_header')
    <h1>Agregar elemento militar</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('elementosMilitares.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del elemento" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="60" required>
                    @error('name')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="birthdate">Fecha de nacimiento</label>
                    <input type="date" name="birthdate" class="form-control" required>
                    @error('birthdate')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="cellphone">Teléfono</label>
                    <input type="text" name="cellphone" class="form-control" placeholder="Ingrese el teléfono del elemento" pattern="\d{10}" minlength="10" maxlength="10" required>
                    @error('cellphone')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" placeholder="Ingrese la dirección del elemento" maxlength="70" required>
                    @error('address')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="admission">Fecha de admisión</label>
                    <input type="date" name="admission" class="form-control" required>
                    @error('admission')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="militarygrade">Grado militar</label>
                    <input type="text" name="militarygrade" class="form-control" placeholder="Ingrese el grado del elemento" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('militarygrade')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="location">Ubicación</label>
                    <input type="text" name="location" class="form-control" placeholder="Ingrese la ubicación actual del elemento" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('location')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="unit">Unidad</label>
                    <input type="unit" name="unit" class="form-control" placeholder="Ingrese la unidad a la que pertenece el elemento" pattern="[A-Za-zÁÉÍÓÚÜáéíóúü\s]+" minlength="1" maxlength="20" required>
                    @error('unit')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="servicestate">Estado del servicio</label>
                    <select name="servicestate" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione un estado de servicio</option>
                        <option value="Activo">Activo</option>
                        <option value="Suspendido">Suspendido</option>
                        <option value="Evaluación">Evaluación</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                    @error('servicestate')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Agregar elemento</button>
            </form>
        </div>
    </div>
@stop