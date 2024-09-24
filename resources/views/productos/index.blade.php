@extends('layout.app')
@section('content')
<main class="app-main"> <!--begin::App Content Header-->
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 my-5">
                        <div class="px-2 row">
                            <div class="col-lg-12">
                                @include('flash::message')
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Inventario</h3>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ url('/exportar-productos') }}" class="btn btn-info mr-1">
                                    <span class="material-icons" style="vertical-align: middle;">
                                        print
                                    </span>
                                    Exportar Productos
                                </a>

                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#importModal">
                                    Cargar Productos desde Excel
                                </button>
                                <a href="{{route('productos.create')}}"
                                    class="btn btn-primary  round mx-1">Registrar</a>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('productos.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Cargar Productos desde Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para cargar el archivo Excel -->
                <form action="{{ route('productos.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Selecciona el archivo Excel</label>
                        <input type="file" name="file" class="form-control" required accept=".xlsx, .xls">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Cargar Productos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection