<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="{{ route('insumo.update', $insumo) }}" method="post">
        @csrf
        @method('PUT')
        <label for="insumodescripcion">Descripción del insumo:</label>
        <input type="text" name="insumodescripcion" value="{{$insumo->insumodescripcion}}"><br>
        
        <label for="insumocantidad">Cantidad de insumo en piezas:</label>
        <input type="text" name="insumocantidad" value="{{$insumo->insumocantidad}}"><br>

        <select name="id_inventario">
            @foreach ($inventarios as $inventario)
                <option value="{{ $inventario->id }}" @selected($inventario->id == $insumo->inventario_id)>
                    {{ $inventario->descripcion }}
                </option>
            @endforeach
        </select>
        <br>

        <input type="submit" value="Actualizar insumo">
    </form>

</body>
</html>