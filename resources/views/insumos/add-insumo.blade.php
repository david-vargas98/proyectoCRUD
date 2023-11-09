@extends('adminlte::page')

@section('title', 'Nuevo insumo')

@section('content_header')
    <h1>Nuevo insumo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('insumo.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="insumodescripcion">Descripción del insumo:</label>
                    <input type="text" name="insumodescripcion" class="form-control" minlength="6" maxlength="20" required><br>
                    
                    <label for="insumocantidad">Cantidad de insumo en piezas:</label>
                    <input type="text" name="insumocantidad" class="form-control" pattern="^[0-9]+$" minlength="1" maxlength="10" required><br>
                    Agregar al inventario:
                    <select name="id_inventario" class="form-control" required>
                        @foreach ($inventarios as $inventario)
                            <option value="{{ $inventario->id }}">
                                {{ $inventario->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="text-center">
                    <button class="btn btn-success">
                        <i class="fas fa-plus"></i> Agregar insumo
                    </button>
                </div>
                {{-- Validación: permite acceder al mensaje de error específico asociado con el campo 'descripcion' si hay un error de validación. --}}
                @error('insumodescripcion')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
                @error('insumocantidad')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop