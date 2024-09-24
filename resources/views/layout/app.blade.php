<!DOCTYPE html>
<html lang="es">
<style>
    /* Custom spinner color */
    .spinner-border {
        color: teal; /* Change this to any teal color you prefer */
    }
</style>

@include('layout.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    
    <div class="app-wrapper" id="app-wrapper">
        <!-- Spinner -->
        <div id="loadingSpinner" class="d-flex justify-content-center align-items-center" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255, 255, 255, 0.8); z-index: 1050;">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <!--begin::Header-->
        @include('layout.cabecera')

        <!--begin::Menu-->
        @include('layout.menu')

        <!--begin::Content-->
        <div id="contentArea" style="display: none;">
            @yield('content')
        </div>
        <!--end::Content-->

        <!-- Scripts -->
        @stack('third_party_scripts')
        @stack('page_scripts')

    </div>

    <!-- Yield JS Scripts -->
    @yield('js')

    <!-- Include Scripts -->
    @include('layout.script')
    @include('sweetalert::alert')
    @include('layout.datatables_css')
    @include('layout.datatables_js')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script>
      
        window.onload = function() {
           
            const spinner = document.getElementById('loadingSpinner');
            const contentArea = document.getElementById('contentArea');

          
            
            // Hide the spinner
            spinner.style.display = 'none'; // Hide spinner

            // Force the hide after a small timeout
            setTimeout(() => {
                console.log('Forcing spinner to hide.');
                spinner.style.visibility = 'hidden'; // Set visibility hidden just in case
            }, 100);

            // Show the content
            contentArea.style.display = 'block'; // Show content
        };

        // Check spinner visibility
        setTimeout(function() {
            if (document.getElementById('loadingSpinner').style.display !== 'none') {
                console.log('Spinner is still visible after load.');
            }
        }, 1000);
    </script>

</body>

</html>
