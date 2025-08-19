@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Crear roles de usuarios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.store')}}" method="POST">
                @include('admin.roles.partials.form')
                <button class="btn btn-primary">Crear rol</button>
            </form>
        </div>
    </div>
@stop