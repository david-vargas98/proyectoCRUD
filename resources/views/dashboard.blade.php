@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Proyecto Final de Laravel</h1>
    <h3 class="text-center">Bienvenido al Sistema de Administración de Clientes e Inventarios</h3>
@stop

@section('content')
    <div class="text-center">
        <p>En el sidebar podrá encontrar las diferentes rutas a las funciones que se implementaron en este sistema, si llega a existir alguna duda sobre los puntos a revisar, no dude en notificarlo, con gusto responderé a la brevedad.</p>
    </div>
    <img src="{{asset('vendor/adminlte/dist/img/chemsito.jpg')}}" alt="chemsito.jpg" style="display: block; margin-left: auto; margin-right: auto; margin-top: 50px;">
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop