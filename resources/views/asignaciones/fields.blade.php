<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir CSS de Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Incluir JS de Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<div class="row">


<div class="col-md-12 mt-2 mb-2">
    <label for="status"><strong>Tipo</strong></label>
    {!! Form::select('tipo', [
        'SALIDA PARA COCINA' => 'Salida para cocina',
        'SALIDA PARA CONSUMO' => 'Salida para consumo',
    ], null , ['class' => 'form-control', 'placeholder' => 'Selecciona un estado']) !!}
</div>

    <div class="col-md-12 mt-4">
        <label for=""><strong>Descripción de la Salida</strong></label>
        {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripción del producto', 'rows' => 3]) !!}
    </div>

   
    <div class="col-md-12 mt-4">
        <div class="d-flex justify-content-end mt-3 mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuscarProveedor">
                Buscar Beneficiario
            </button>
        </div>


        <table class="table table-hover" id="tablaProveedores">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>RIF</th>
                    <th>Parroquia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irán los productos seleccionados -->
            </tbody>
        </table>
    </div>
    <div class="col-md-12 mt-4">
        <div class="d-flex justify-content-end mt-3 mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuscarProducto">
                Buscar Producto
            </button>
        </div>


        <table class="table table-hover" id="tablaProductos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irán los productos seleccionados -->
            </tbody>
        </table>
    </div>


    <div class="col-md-6"></div>

    <div class="col-md-6">
        <div class="float-end">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary round']) !!}
        </div>
    </div>
</div>
<div class="modal fade" id="modalBuscarProducto" tabindex="-1" aria-labelledby="modalBuscarProductoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: teal; color: white;">
                <h5 class="modal-title" id="modalBuscarProductoLabel">Buscar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for=""><strong>Buscar Producto</strong></label>
                        <input type="text" id="buscador" placeholder="Buscar producto..." class="form-control">
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for=""><strong>Resultados de Búsqueda</strong></label>
                        <table class="table table-hover" id="tablaResultados">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Cantidad en Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaProductos">
                                <!-- Aquí se agregarán los productos de búsqueda -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBuscarProveedor" tabindex="-1" aria-labelledby="modalBuscarProveedorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: teal; color: white;">
                <h5 class="modal-title" id="modalBuscarProductoLabel">Buscar Beneficiario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for=""><strong>Buscar Beneficiario</strong></label>
                        <input type="text" id="buscador2" placeholder="Buscar beneficiario..." class="form-control">
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for=""><strong>Resultados de Búsqueda</strong></label>
                        <table class="table table-hover" id="tablaResultados">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>RIF</th>
                                    <th>Parroquia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaProveedores">
                                <!-- Aquí se agregarán los productos de búsqueda -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/sweetalert2.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#buscador').on('input', function () {
            const query = $(this).val();

            if (query.length >= 4) {
                $.ajax({
                    url: '/buscarProductos', // Asegúrate de que esta URL sea correcta
                    method: 'GET',
                    data: { q: query },
                    dataType: 'json',
                    success: function (data) {
                        // Limpiar la lista de productos
                        $('#listaProductos').empty();

                        // Comprobar si hay resultados
                        if (data.length > 0) {
                            $.each(data, function (index, item) {
                                $('#listaProductos').append(
                                    `<tr class="producto-item" data-id="${item.id}" data-descripcion="${item.descripcion}" data-stock="${item.cantidad}">
                                    <td>${item.nombre}</td>
                                    <td>${item.descripcion}</td>
                                    <td>${item.cantidad}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm agregarProducto">Agregar</button>
                                    </td>
                                </tr>`
                                );
                            });
                        } else {
                            $('#listaProductos').append('<tr><td colspan="4">No se encontraron productos.</td></tr>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la búsqueda:', error);
                    }
                });
            } else {
                $('#listaProductos').empty(); // Limpiar la lista si menos de 4 caracteres
            }
        });

        // Evento para agregar productos a la tabla principal
        $(document).on('click', '.agregarProducto', function () {
            const row = $(this).closest('tr');
            const id = row.data('id');
            const nombre = row.children('td').eq(0).text();
            const descripcion = row.children('td').eq(1).text();
            const stock = row.children('td').eq(2).text();

            // Verificar si el producto ya está en la tabla principal
            let existe = false;
            $('#tablaProductos tbody tr').each(function () {
                if ($(this).data('id') == id) {
                    existe = true;
                    return false; // Salir del each
                }
            });

            // Si el producto no existe, agregarlo
            if (!existe) {
                $('#tablaProductos tbody').append(
                    `<tr data-id="${id}">
                    <td>${nombre}</td>
                    <td>${descripcion}</td>
                    <td><input type="number" value="1" min="1" class="form-control cantidadProducto"></td>
                    <td><button class="btn btn-danger btn-sm eliminarProducto">Eliminar</button></td>
                </tr>`
                );

            } else {
                alert('Este producto ya ha sido agregado.');
            }
        });

        // Evento para eliminar productos de la tabla principal
        $(document).on('click', '.eliminarProducto', function () {
            $(this).closest('tr').remove();
        });

        //PROVEEDORES

        $('#buscador2').on('input', function () {
            const query = $(this).val();

            if (query.length >= 4) {
                $.ajax({
                    url: '/buscarProveedores', // Asegúrate de que esta URL sea correcta
                    method: 'GET',
                    data: { q: query },
                    dataType: 'json',
                    success: function (data) {
                        // Limpiar la lista de productos
                        $('#listaProveedores').empty();

                        // Comprobar si hay resultados
                        if (data.length > 0) {
                            $.each(data, function (index, item) {
                                $('#listaProveedores').append(
                                    `<tr class="producto-item" data-id="${item.id}" data-nombre="${item.nombre}" data-rif="${item.rif}">
                                    <td>${item.razon_social}</td>
                                    <td>${item.rif}</td>
                                    <td>${item.parroquia}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm agregarProveedor">Agregar</button>
                                    </td>
                                </tr>`
                                );
                            });
                        } else {
                            $('#listaProveedores').append('<tr><td colspan="4">No se encontraron proveedores.</td></tr>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la búsqueda:', error);
                    }
                });
            } else {
                $('#listaProveedores').empty(); // Limpiar la lista si menos de 4 caracteres
            }
        });

        $(document).on('click', '.agregarProveedor', function () {
            const row = $(this).closest('tr');
            const id = row.data('id');
            const nombre = row.children('td').eq(0).text();
            const descripcion = row.children('td').eq(1).text();
            const stock = row.children('td').eq(2).text();

            // Verificar si el producto ya está en la tabla principal
            let existe = false;
            $('#tablaProveedores tbody tr').each(function () {
                if ($(this).data('id') == id) {
                    existe = true;
                    return false; // Salir del each
                }
            });

            // Si el producto no existe, agregarlo
            if (!existe) {
                $('#tablaProveedores tbody').append(
                    `<tr data-id="${id}">
                    <td>${nombre}</td>
                    <td>${descripcion}</td>
                    <td>${stock}</td>
                    <td><button class="btn btn-danger btn-sm eliminarBeneficiario">Eliminar</button></td>
                </tr>`
                );

            } else {
                alert('Este beneficiario ya ha sido agregado.');
            }
        });

        // Evento para eliminar productos de la tabla principal
        $(document).on('click', '.eliminarBeneficiario', function () {
            $(this).closest('tr').remove();
        });

        $('#formularioSolicitud').on('submit', function (event) {
            event.preventDefault();

            // Limpiar campos ocultos anteriores
            $(this).find('input[name^="productos"]').remove();

            $('#tablaProductos tbody tr').each(function () {
                const nombre = $(this).find('td').eq(0).text();
                const descripcion = $(this).find('td').eq(1).text();
                const cantidad = $(this).find('.cantidadProducto').val();
                const precio = $(this).find('.precioProducto').val();

                $('<input>').attr({
                    type: 'hidden',
                    name: 'productos[]',
                    value: JSON.stringify({
                        nombre: nombre,
                        descripcion: descripcion,
                        cantidad: cantidad,
                    })
                }).appendTo(this);
            });

            $(this).find('input[name^="proveedores"]').remove();

            $('#tablaProveedores tbody tr').each(function () {
                const nombre = $(this).find('td').eq(0).text();
                const rif = $(this).find('td').eq(1).text();

                $('<input>').attr({
                    type: 'hidden',
                    name: 'proveedores[]',
                    value: JSON.stringify({
                        nombre: nombre,
                        rif: rif,
                    })
                }).appendTo(this);
            });

            // Ahora se puede enviar el formulario
            this.submit();
        });
    });

</script>