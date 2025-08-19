@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
    {{-- Se pide que se renderice el componente dentro de la carpeta admin, llamado: users-index --}}
    @livewire('admin.users-index')
@stop