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
    <form action="/inventario" method="POST">
        @csrf
        <div>
            <label for="descripcion-Inventario">Descripción del inventario:</label>
            <input type="text" name="descripcion-Inventario" placeholder="Descripción"  required>
            <button type="submit">Agregar nuevo inventario</button>
        </div>
    </form>
</body>
</html>