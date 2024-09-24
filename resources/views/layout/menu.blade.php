<aside class="app-sidebar  shadow " data-bs-theme="dark" style="color: white !important;border:none !important;background-color: teal !important; color: white !important;"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand" style="border:none!important"> <!--begin::Brand Link--> <a href="{{route('home')}}" class="brand-link">
            <!--begin::Brand Image--><span style="text-decoration: none; color: white !important;"> PDVSA</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->  
    <div class="sidebar-wrapper">
    <nav class="mt-2"> <!--begin::Sidebar Menu-->
    <ul class="nav sidebar-menu flex-column" style="border:none!important" role="menu">
      
      
    <li class="nav-item">
    <a href="{{ route('categorias.index') }}" class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">label_outline</i>
        <p style="color: white;">Categorías</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('inventario') }}" class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">inventory</i>
        <p style="color: white;">Inventario</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('asignaciones.index')}}" class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">shopping_cart</i>
        <p style="color: white;">Salidas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('asignaciones.create')}}" class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">sell</i>
        <p style="color: white;">Registrar salida</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('solicitudes.index')}}" class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">shopping_basket</i>
        <p style="color: white;">Entradas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('solicitudes.create') }}" class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">add_shopping_cart</i>
        <p style="color: white;">Ejecución</p>
    </a>
</li>

<li class="nav-item">
    <a href={{route('proveedores.index')}} class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">people</i>
        <p style="color: white;">Proveedores / Beneficiario</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('usuarios.index') }}" class="nav-link">
        <i class="material-icons" style="font-size: 20px; color: white;">people_outline</i>
        <p style="color: white;">Usuarios</p>
    </a>
</li>

    
       
     
      
     
    </ul> <!--end::Sidebar Menu-->
</nav>

    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->

@vite(['resources/sass/app.scss', 'resources/js/app.js'])
