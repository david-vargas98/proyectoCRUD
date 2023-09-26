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
    <h1>Crear inventario</h1>
    <h2>Ingrese los datos para agregar un nuevo inventario:</h2>
    {{-- En vez de /inventario se puede usar: {{route(inventario.store)}} --}}
    <form action="{{ route('inventario.store') }}" method="POST">
        @csrf
        <div>
            <label for="descripcion">Descripción del inventario:</label>
            {{-- Campo de entrada --}}
            <input type="text" name="descripcion" placeholder="Descripción"  required>
            {{-- Validación: permite acceder al mensaje de error específico asociado con el campo 'descripcion' si hay un error de validación. --}}
            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit">Agregar nuevo inventario</button>
        </div>
    </form>
</body>
</html>