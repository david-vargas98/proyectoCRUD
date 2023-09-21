<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creación de inventarios</title>
</head>
<body>
    <h1>Crear inventario</h1>
    <h2>Ingrese los datos para agregar un nuevo inventario:</h2>
    {{-- En vez de /inventario se puede usar: {{route(inventario.store)}} --}}
    <form action="{{ route('inventario.store') }}" method="POST">
        @csrf
        <div>
            <label for="descripcioninv">Descripción del inventario:</label>
            <input type="text" name="descripcioninv" placeholder="Descripción"  required>
            <button type="submit">Agregar nuevo inventario</button>
        </div>
    </form>
</body>
</html>