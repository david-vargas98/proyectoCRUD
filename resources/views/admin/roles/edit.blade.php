@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Editar rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.edit', $role)}}" method="POST">
                @method('PUT')
                @include('admin.roles.partials.form')
                <button class="btn btn-primary">Editar rol</button>
            </form>
        </div>
    </div>
@stop