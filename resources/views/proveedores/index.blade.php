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
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            </div>
                         
                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Proveedores / Beneficiarios</h3>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('export.proveedores') }}" class="btn btn-info mr-1">
                                    <span class="material-icons" style="vertical-align: middle;">
                                        print
                                    </span>
                                    Exportar Proveedores
                                </a>
                                <!-- Botón para abrir el modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#importModal">
                                     Cargar Proveedores desde Excel
                                </button>

                                <a href="{{route('proveedores.create')}}"
                                    class="btn btn-primary  round mx-1">Registrar</a>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('proveedores.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: teal; color: white;">
                <h5 class="modal-title" id="importModalLabel">Importar Proveedores desde Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de subida de archivo -->
                <form action="{{ route('import.proveedores') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Subir archivo Excel:</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Importar Proveedores</button>
                </form>
            </div>
        </div>
    </div>
</div>
