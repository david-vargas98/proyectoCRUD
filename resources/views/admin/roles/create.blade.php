@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Crear roles de usuarios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del rol">
                    @error('name') {{-- Error de validación en el campo name --}}
                        <small class="text-danger">
                            {{$message}}
                        </small>
                    @enderror
                </div>
                <h2 class="h3">Lista de permisos</h2>
                @foreach ($permisos as $permiso)
                    <div>
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{$permiso->id}}" class="mr-1">
                            {{$permiso->description}}
                        </label>
                    </div>
                @endforeach
                <button class="btn btn-primary">Crear rol</button>
            </form>
        </div>
    </div>
@stop