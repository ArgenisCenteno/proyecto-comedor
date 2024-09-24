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
                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Salidas</h3>
                            </div>
                           
                            <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exportModal">
                                    Consultar Asignaciones
                                </button>
                                <a href="{{route('asignaciones.create')}}"
                                    class="btn btn-primary  round mx-1">Registrar</a>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('asignaciones.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection
<!-- Button to Open Modal -->


<!-- Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: teal; color: white;">
                <h5 class="modal-title" id="exportModalLabel">Exportar Asignaciones por Rango de Fecha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('asignaciones.export') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Fecha de Inicio</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Fecha de Fin</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Exportar</button>
                </form>
            </div>
        </div>
    </div>
</div>