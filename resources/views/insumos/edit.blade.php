@extends('adminlte::page')

@section('title', 'Editar insumo')

@section('content_header')
    <h1>Modificar datos del insumo</h1>
@stop

@section('content')
    <form action="{{ route('insumo.update', $insumo) }}" method="post">
        @csrf
        @method('PUT')
        <label for="insumodescripcion">Descripción del insumo:</label>
        <input type="text" name="insumodescripcion" value="{{$insumo->insumodescripcion}}"><br>

        <label for="insumocantidad">Cantidad de insumo en piezas:</label>
        <input type="text" name="insumocantidad" value="{{$insumo->insumocantidad}}"><br>

        Agregar al inventario:
        <select name="id_inventario">
            @foreach ($inventarios as $inventario)
                <option value="{{ $inventario->id }}" @selected($inventario->id == $insumo->inventario_id)>
                    {{ $inventario->descripcion }}
                </option>
            @endforeach
        </select>
        <br>
        <div class="text-center">
            <input type="submit" value="Actualizar insumo">
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