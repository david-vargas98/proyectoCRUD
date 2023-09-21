<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Índice de inventarios</title>
</head>
<body>
    <h1>Listado de inventarios, funciona :D</h1>
    <!-- Se realiza iteraciones en una lista no ordenada -->
    <ul>
        <!-- Se retoma la variable que se usó en 'compact' -->
        @foreach ($inventarios as $inventario)
            <li>{{$inventario->descripcion}}</li>
        @endforeach
    </ul>
</body>
</html>