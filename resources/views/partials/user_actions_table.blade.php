@extends('adminlte::page')

@section('title', 'Acciones')

@section('content_header')
    <h1>Acciones realizadas por usuarios</h1>
@stop

@section('content')
    @livewire('admin.acciones-usuarios')
@stop
