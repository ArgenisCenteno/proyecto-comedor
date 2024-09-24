<nav class="app-header navbar navbar-expand bg-body" style="font-size: 14px; border: none"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">

                </a>
            </li>


        </ul>

        <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item">
    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="material-icons" style="color: teal; font-size: 40px;">logout</i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>

        </ul> <!--end::End Navbar Links-->

    </div> <!--end::Container-->
</nav> <!--end::Header--> <!--begin::Sidebar-->
@include('layout.script')
<script>
    // Escucha el evento 'input' en todos los campos de tipo text y textareas y convierte a mayúsculas
    document.addEventListener('DOMContentLoaded', function () {
        // Selecciona todos los inputs de tipo text y los textareas
        const textInputs = document.querySelectorAll('input[type="text"], textarea');

        // Itera sobre cada input y textarea y agrega el listener
        textInputs.forEach(function (input) {
            input.addEventListener('input', function () {
                // Convierte el valor del input o textarea a mayúsculas
                this.value = this.value.toUpperCase();
            });
        });
    });
</script>