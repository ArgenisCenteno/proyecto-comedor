<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Creado Por</th>
            <th>Status</th>
            <th>Fecha de Creación</th>
            <th>Fecha de Actualización</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asignaciones as $asignacion)
            <tr>
                <td>{{ $asignacion->id }}</td>
                <td>{{ $asignacion->tipo }}</td>
                <td>{{ $asignacion->fecha }}</td>
                <td>{{ $asignacion->descripcion }}</td>
                <td>{{ $asignacion->creador->name }}</td> <!-- Assuming 'creador' is a relation -->
                <td>{{ $asignacion->status }}</td>
                <td>{{ $asignacion->created_at }}</td>
                <td>{{ $asignacion->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
