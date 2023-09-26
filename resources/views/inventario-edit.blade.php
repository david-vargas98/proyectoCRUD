<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creación de inventarios</title>
    {{-- Se agrega bootstrap por CDN porque no sé instalarlo xddd mañana le pregunto al profe --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <h1>Editar inventario</h1>
    <h2>Ingrese los datos para editar el inventario:</h2>
    {{-- A diferencia del create, debe apuntar a: {{route(inventario.update)}} --}}
    <form action="{{ route('inventario.update', $inventario) }}" method="POST">
        @csrf
        {{-- Se debe poner la modificación de el método de envío a put|patch --}}
        @method('put') {{-- O patch --}}
        <div> 
            <label for="descripcion">Descripción del inventario:</label>
            {{-- Campo de entrada --}} {{-- Se agrega el value para mostrar el valor del inventario --}}
            <input type="text" name="descripcion" placeholder="Descripción" value="{{$inventario->descripcion}}" required>
            {{-- Validación: permite acceder al mensaje de error específico asociado con el campo 'descripcion' si hay un error de validación. --}}
            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit">Editar descripción del inventario</button>
        </div>
    </form>
</body>
</html>