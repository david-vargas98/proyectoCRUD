@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center display-4">Bienvenido al Dashboard de Pegasus</h1>
@stop

@section('content')
    <div class="text-center">
        <p>En el dashboard, encontrarás información clave y de rápido acceso de las estadísticas sobre el redireccionamiento militar en general:</p>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="text-center info-box-text">Personal Militar</span>
                    <span class="info-box-number">Total: {{$totalPersonalMilitar->count()}}</span>
                    <span class="info-box-number">Activos: {{$totalPersonalMilitar->where('servicestate', 'Activo')->count()}}</span>
                    <span class="info-box-number">Suspendidos: {{$totalPersonalMilitar->where('servicestate', 'Suspendido')->count()}}</span>
                    <span class="info-box-number">En evaluación: {{$totalPersonalMilitar->where('servicestate', 'Evaluación')->count()}}</span>
                    <span class="info-box-number">Servicio finalizado: {{$totalPersonalMilitar->where('servicestate', 'Terminado')->count()}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-user-md"></i></span>
                <div class="info-box-content">
                    <span class="text-center info-box-text">Pacientes</span>
                    <span class="info-box-number">Total: {{$totalPacientes->count()}}</span>
                    <span class="info-box-number">TEPT de severidad baja: {{$totalPacientes->where('severity', 'Bajo')->count()}}</span>
                    <span class="info-box-number">TEPT de severidad media: {{$totalPacientes->where('severity', 'Medio')->count()}}</span>
                    <span class="info-box-number">TEPT de severidad alta: {{$totalPacientes->where('severity', 'Alto')->count()}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="text-center info-box-text">Citas</span>
                    <span class="info-box-number">Total: {{$totalCitas->count()}}</span>
                    <span class="info-box-number">Citas programadas: {{$totalCitas->where('appointment_status', 'Programada')->count()}}</span>
                    <span class="info-box-number">Citas completadas: {{$totalCitas->where('appointment_status', 'Cancelada')->count()}}</span>
                    <span class="info-box-number">Citas canceladas: {{$totalCitas->where('appointment_status', 'Completada')->count()}}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <p>Explora las opciones del menú lateral para acceder a las funciones disponibles según tu rol.</p>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
