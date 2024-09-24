<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Uso</th>
            <th>Status</th>
            <th>Proveedor</th>
            <th>Analista</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->id }}</td>
                <td>{{ $solicitud->fecha }}</td>
                <td>{{ $solicitud->descripcion }}</td>
                <td>{{ $solicitud->uso }}</td>
                <td>{{ $solicitud->status }}</td>
                <td>{{ $solicitud->proveedor->razon_social }}</td> <!-- Assuming 'proveedor' is the relation -->
                <td>{{ $solicitud->user->name }}</td> <!-- Assuming 'creadoPor' is a relation to User -->
                <td>{{ $solicitud->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
