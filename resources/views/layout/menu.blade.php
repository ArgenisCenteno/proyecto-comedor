<aside class="app-sidebar shadow" data-bs-theme="dark" style="color: white !important; border: none !important; background-color: teal !important;">
    <div class="sidebar-brand" style="border: none!important">
        <a href="{{ route('home') }}" class="brand-link">
            <span style="text-decoration: none; color: white !important;"> PDVSA</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" style="border: none!important" role="menu">
                <li class="nav-item">
                    <a href="{{ route('categorias.index') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">label_outline</i>
                        <p style="color: white; margin-left: 8px;">Categorías</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('inventario') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">store_front</i>
                        <p style="color: white; margin-left: -110px;">Inventario</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('asignaciones.index') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">shopping_cart</i>
                        <p style="color: white; margin-left: 8px;">Salidas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('asignaciones.create') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">shopping_bag</i>
                        <p style="color: white; margin-left: -150px;">Registrar salida</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('solicitudes.index') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">shopping_basket</i>
                        <p style="color: white; margin-left: 8px;">Entradas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('solicitudes.create') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">add_shopping_cart</i>
                        <p style="color: white; margin-left: 8px;">Ejecución</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('proveedores.index') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">people</i>
                        <p style="color: white; margin-left: 8px;">Proveedores / Beneficiario</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('usuarios.index') }}" class="nav-link">
                        <i class="material-icons" style="font-size: 20px; color: white;">people_outline</i>
                        <p style="color: white; margin-left: 8px;">Usuarios</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
