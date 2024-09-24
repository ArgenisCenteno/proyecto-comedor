@extends('layout.app')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">


            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Unified Small Box Card -->
                    <div class="small-box text-white" style="background-color: teal;">
                        <div class="inner">
                            <h3>PDVSA SGI</h3>
                        </div>
                        <div class="d-flex flex-wrap justify-content-around">
                            <!-- Productos -->
                        
                            <!-- Solicitudes -->
                            <div class="text-center">
                                <span class="material-icons" style="font-size: 48px;">assignment</span>
                                <h4>{{$solicitudes}}</h4>
                                <p>Entradas</p>
                            </div>

                            <!-- Asignaciones -->
                            <div class="text-center">
                                <span class="material-icons" style="font-size: 48px;">assignment_ind</span>
                                <h4>{{$asignaciones}}</h4>
                                <p>Salidas</p>
                            </div>

                            <!-- Bajo Stock -->
                            <div class="text-center">
                                <span class="material-icons" style="font-size: 48px;">warning</span>
                                <h4>{{$bajoStock}}</h4>
                                <p>Minímo </p>
                            </div>

                            <!-- Proveedores -->
                            <div class="text-center">
                                <span class="material-icons" style="font-size: 48px;">people</span>
                                <h4>{{$proveedores}}</h4>
                                <p>Proveedores</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="card-title">Estado de Movimientos</h4>
                        </div>
                        <div class="card-body" style="background-color: teal; ">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon" style="background: #28a745;">
                                            <i class="material-icons" style="color: white;">check_circle</i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black;">Salidas Aprobadas</span>
                                            <span class="info-box-number" style="color: black;">10</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon" style="background: #ffc107;">
                                            <i class="material-icons" style="color: black;">hourglass_empty</i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black;">Salidas Pendientes</span>
                                            <span class="info-box-number" style="color: black;">5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon" style="background: #007bff;">
                                            <i class="material-icons" style="color: black;">check_circle</i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black;">Entradas Aprobadas</span>
                                            <span class="info-box-number" style="color: black;">8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon" style="background: #ffc107;">
                                            <i class="material-icons" style="color: black;">hourglass_empty</i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black;">Entradas Pendientes</span>
                                            <span class="info-box-number" style="color: black;">3</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon" style="background: #dc3545;">
                                            <i class="material-icons" style="color: black;">cancel</i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black;">Salidas Canceladas</span>
                                            <span class="info-box-number" style="color: black;">2</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon" style="background: #dc3545;">
                                            <i class="material-icons" style="color: black;">cancel</i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black;">Entradas Canceladas</span>
                                            <span class="info-box-number" style="color: black;">1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('layout.script')

@endsection