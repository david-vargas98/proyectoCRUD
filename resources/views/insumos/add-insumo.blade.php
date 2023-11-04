@extends('adminlte::page')

@section('title', 'Nuevo insumo')

@section('content_header')
    <h1>Nuevo insumo</h1>
@stop

@section('content')
    <form action="{{ route('insumo.store') }}" method="post">
        @csrf
        <label for="insumodescripcion">Descripción del insumo:</label>
        <input type="text" name="insumodescripcion"><br>

        <label for="insumocantidad">Cantidad de insumo en piezas:</label>
        <input type="text" name="insumocantidad"><br>

        Agregar al inventario:
        <select name="id_inventario">
            @foreach ($inventarios as $inventario)
                <option value="{{ $inventario->id }}">
                    {{ $inventario->descripcion }}
                </option>
            @endforeach
        </select>
        <br>
        <div class="text-center">
            <input type="submit" value="Agregar insumo">
        </div>
        {{-- Validación: permite acceder al mensaje de error específico asociado con el campo 'descripcion' si hay un error de validación. --}}
        @error('insumodescripcion')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
        @error('insumocantidad')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop