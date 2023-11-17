@extends('adminlte::page')

@section('title', 'Agregar')

@section('content_header')
    <h1>Agregar paciente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('pacientes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="military_element_id">Elemento militar</label>
                    <select name="military_element_id" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Selecciona un elemento</option>
                        @foreach ($elementos as $elemento)
                            <option value="{{ $elemento->id }}">
                                {{ $elemento->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('military_element_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="disorder">Trastorno psicológico</label>
                    <select name="disorder" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="TEPT">TEPT</option>
                    </select>
                    @error('disorder')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="severity">Severidad de trastorno</label>
                    <select name="severity" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione la severidad</option>
                        <option value="Bajo">Bajo</option>
                        <option value="Medio">Medio</option>
                        <option value="Alto">Alto</option>
                    </select>
                    @error('severity')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Agregar elemento</button>
            </form>
        </div>
    </div>
@stop