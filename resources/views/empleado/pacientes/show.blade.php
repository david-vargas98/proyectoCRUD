@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
    <h1>Sugerencias de actividades para <span class="text-primary">{{$paciente->militaryElement->name}}</span></h1>
@stop

@section('content')
    @if($paciente->severity === 'Bajo')
        @include('partials.low_severity_table', ['lowSeverityRecords' => $lowSeverityRecords])
    @elseif($paciente->severity === 'Medio')
        @include('partials.medium_severity_table', ['mediumSeverityRecords' => $mediumSeverityRecords])
    @elseif($paciente->severity === 'Alto')
        @include('partials.high_severity_table', ['highSeverityRecords' => $highSeverityRecords])
    @else
        <p class="alert alert-info">No hay sugerencias para este paciente</p>
        <div class="text-center">
            <a href="{{ route('pacientes.index') }}">
                <button class="btn btn-sm btn-primary mt-2 mr-2">
                    <i class="fas fa-backward"></i> Ir al índice de pacientes
                </button>
            </a>
        </div>
    @endif
@stop
