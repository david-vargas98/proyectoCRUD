@csrf
<div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del rol" value="{{ isset($role) ? $role->name : old('name') }}">
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
            <input type="checkbox" name="permissions[]" value="{{$permiso->id}}" class="mr-1" {{ isset($role) &&$role->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
            {{$permiso->description}}
        </label>
    </div>
@endforeach