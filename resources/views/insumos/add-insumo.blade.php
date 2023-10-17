<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="{{ route('insumo.store') }}" method="post">
        @csrf
        <label for="insumodescripcion">Descripción del insumo:</label>
        <input type="text" name="insumodescripcion"><br>
        
        <label for="insumocantidad">Cantidad de insumo en piezas:</label>
        <input type="text" name="insumocantidad"><br>

        <select name="inventario_id">
            @foreach ($inventarios as $inventario)
                <option value="{{ $inventario->id }}">
                    {{ $inventario->descripcion }}
                </option>
            @endforeach
        </select>
        <br>

        <input type="submit" value="Agregar insumo">
    </form>

</body>
</html>