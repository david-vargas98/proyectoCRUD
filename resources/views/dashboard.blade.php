@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Bienvenido al CRUD de inventarios</h1>
@stop

@section('content')
    <p>En el sidebar podrás encontrar las diferentes rutas a las operaciones básicas para los inventarios, así como el acceso a tu información de perfil.</p>
    <img src="{{asset('vendor/adminlte/dist/img/chemsito.jpg')}}" alt="chemsito.jpg" style="display: block; margin-left: auto; margin-right: auto;">
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop