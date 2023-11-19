<table border="1" class="text-center table table-bordered table-striped table-hover">
    <!-- Encabezados y estructura de la tabla -->
    <thead>
        <tr class="text-sm">
            <th>Servicio de ingenieros</th>
            <th>Servicio de administración</th>
            <th>Servicio de salud</th>
            <th>Servicio de materiales de guerra</th>
            <th>Servicio de transmisiones</th>
            <th>Servicio de transporte</th>
            <th>Servicio de intendencia</th>
            <th>Servicio de justicia</th>
            <!-- Agrega más columnas según sea necesario -->
        </tr>
    </thead>
    <tbody>
        <!-- Recuperar registros para baja severidad -->
        @foreach ($highSeverityRecords as $record)
            <tr>
                <td>{{ $record->engineer_services }}</td>
                <td>{{ $record->management_services }}</td>
                <td>{{ $record->health_services }}</td>
                <td>{{ $record->war_material_services }}</td>
                <td>{{ $record->transmission_services }}</td>
                <td>{{ $record->transport_services }}</td>
                <td>{{ $record->quartermasters_corp }}</td>
                <td>{{ $record->justice_services }}</td>
                <!-- Agrega más celdas según sea necesario -->
            </tr>
        @endforeach
    </tbody>
</table>