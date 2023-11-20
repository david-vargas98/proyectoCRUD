@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>Editar paciente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pacientes.update', $paciente) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="military_element_id">Elemento militar</label>
                    <select name="military_element_id" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Selecciona un elemento</option>
                        @foreach ($elementos as $elemento)
                            <option value="{{ $elemento->id }}" {{ $elemento->id == $paciente->military_element_id ? 'selected' : '' }}>
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
                        <option value="TEPT" {{ $paciente->disorder == 'TEPT' ? 'selected' : '' }}>TEPT</option>
                    </select>
                    @error('disorder')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="severity">Severidad de trastorno</label>
                    <select name="severity" class="form-control" style="width: 250px;" required>
                        <option value="" disabled selected>Seleccione la severidad</option>
                        <option value="Bajo" {{ $paciente->severity == 'Bajo' ? 'selected' : '' }}>Bajo</option>
                        <option value="Medio" {{ $paciente->severity == 'Medio' ? 'selected' : '' }}>Medio</option>
                        <option value="Alto" {{ $paciente->severity == 'Alto' ? 'selected' : '' }}>Alto</option>
                    </select>
                    @error('severity')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                    <label for="user_id">Asignar psicólogo <span class="text-primary">(Opcional)</span></label>
                    <select name="user_id" class="form-control" style="width: 250px;">
                        <option value="" disabled selected>Seleccione un psicólogo</option>
                        @foreach ($psicologos as $psicologo)
                            <option value="{{ $psicologo->id }}" {{ $psicologo->id == $paciente->user_id ? 'selected' : '' }}>
                                {{ $psicologo->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Actualizar paciente</button>
            </form>
        </div>
    </div>
@stop
