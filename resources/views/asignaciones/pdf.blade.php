<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDVSA</title>
   

<style>
      .qr-container {
            margin-top: 20px;
        }
        .firma-container {
            margin-top: 40px;
            border-top: 1px solid #000;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            padding-top: 10px;
            padding-bottom: 20px;
        }
        .firma-text {
            margin-top: 5px;
        }
</style>
</head>

<body
    style="font-family: Arial, sans-serif; margin: 0; padding: 10px; line-height: 1.6; border: none; background-color: #f9f9f9;">
    <div
        style="max-width: 800px; margin: auto; padding: 10px; border-radius: 8px; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <!-- Encabezado -->
        <div
            style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px; border-bottom: 2px solid #ddd;">
            <div style="width: 20%; flex: 1;">
            </div>
            <div style="text-align: center; flex: 1;">

                <h1 style="margin: 0;  color: #333;"></h1>
            </div>

        </div>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <!-- Columna para el Logo -->
                    <th

                        style="border-bottom: 2px solid #ddd; padding: 8px; text-align: center; font-size: 18px; width: 15%;">
                             <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">

                       
                    </th>
                    <!-- Columna para el Nombre de la Empresa -->
                    <th colspan="2"
                        style="border-bottom: 2px solid #ddd; padding: 8px; text-align: center; font-size: 22px; font-weight: bold; width: 70%;">
                        <img src="{{ public_path('iconos/PDVSA-logo-vector-01.webp') }}" alt="Logo"
                        style="max-width: 150px; height: auto;">
                    </th>
                    <!-- Columna para el Número de Venta -->
                    @php
                        $id = str_pad($asignacion->id, 8, "0", STR_PAD_LEFT);
                    @endphp
                    <th
                        style="border-bottom: 2px solid #ddd; padding: 8px; text-align: center; font-size: 22px; width: 15%;">
                        {{$id}}
                    </th>
                </tr>
            </thead>
        </table>


        <!-- Título -->
        <h3 style="text-align: center; color: #333; font-size: 24px; margin: 20px 0;">NOTA DE ENTREGA</h3>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">DIRECCIÓN</th>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">CIUDAD.</th>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">ESTADO.</th>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">FECHA.</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">--------------</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">PUNTA DE MATA</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">MONAGAS</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{$asignacion->fecha ?? ''}}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">DESCRIPCIÓN</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;"> {{$asignacion->descripcion ?? ''}} </td>
                </tr>
            </tbody>
        </table>
        <!-- Detalles del cliente y vendedor -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">BENEFICIARIO</th>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">PERSONAL.</th>

                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                        @foreach($proveedores as $beneficiario)
                            {{ $beneficiario->proveedor->razon_social }}<br>
                        @endforeach
                    </td>

                    <td style="padding: 8px; border-bottom: 1px solid #ddd;"> {{$asignacion->creador->name}} </td>



                </tr>
            </tbody>
        </table>


        <!-- Tabla de productos -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">DESCRIPCION</th>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">CANT.</th>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">UNIDAD MEDIDA.</th>
                    <th style="border-bottom: 2px solid #ddd; padding: 8px; text-align: left;">CATEGORÍA</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($asignacion->productos as $detalle)
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{$detalle->producto->nombre}}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{$detalle->cantidad}}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                            {{ strtoupper($detalle->producto->unidad_medida) }}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                            {{$detalle->producto->subCategoria->nombre}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Resumen de totales -->
        <div class="qr-container">
        <!-- Renderiza el código QR -->
    </div>

    <!-- Espacio para firma -->
    <div class="firma-container">
        <p class="text-center">Firma de recibido:</p>
        <div style="height: 60px; border-top: 1px solid #000;"></div> <!-- Línea para la firma -->
    </div>
    </div>
</body>

</html>