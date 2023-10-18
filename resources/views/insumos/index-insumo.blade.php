<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">Índice de insumos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Inventario</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insumos as $insumo)
                <tr>
                    <td>{{$insumo->inventario->descripcion}}</td>
                    <td>{{$insumo->insumodescripcion}}</td>
                    <td>{{$insumo->insumocantidad}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-around">
        <img src="{{asset('img/perrito.png')}}" alt="perrito.png">
    </div>
    @if ($insumos->isEmpty())
        <h3 class="text-center" style="margin-top: 40px">Nada por aquí...</h3>
    @endif
</body>
</html>