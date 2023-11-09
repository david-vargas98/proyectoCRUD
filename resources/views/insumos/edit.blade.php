@extends('adminlte::page')

@section('title', 'Editar insumo')

@section('content_header')
    <h1>Modificar datos del insumo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('insumo.update', $insumo) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="insumodescripcion">Descripción del insumo:</label>
                    <input type="text" name="insumodescripcion" class="form-control" value="{{$insumo->insumodescripcion}}" minlength="3"    maxlength="20" required><br>
                    
                    <label for="insumocantidad">Cantidad de insumo en piezas:</label>
                    <input type="text" name="insumocantidad" class="form-control" value="{{$insumo->insumocantidad}}" pattern="^[0-9]+$"     minlength="1" maxlength="10" required><br>
                    
                    Agregar al inventario:
                    <select name="id_inventario" class="form-control" style="width: 150px;">
                        @foreach ($inventarios as $inventario)
                            <option value="{{ $inventario->id }}" @selected($inventario->id == $insumo->inventario_id)>
                                {{ $inventario->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Actualizar insumo
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