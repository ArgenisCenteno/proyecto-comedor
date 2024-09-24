<?php

namespace App\Http\Controllers;

use App\Exports\SolicitudesExport;
use App\Models\Producto;
use App\Models\ProductoOrdenado;
use App\Models\Proveedor;
use App\Models\Requerimiento;
use App\Models\Solicitud;
use App\Models\Tramites;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Alert;
class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $solicitudes = Solicitud::with('user', 'proveedor')->get();

            return DataTables::of($solicitudes)
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('solicitudes.edit', [$row->id]) . '" ><span class="material-icons">edit</span></a>
                        <form action="' . route('solicitudes.destroy', [$row->id]) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="border-0 bg-transparent p-0" ><span class="material-icons text-danger">delete</span></button>
                        </form>';
                })
                ->editColumn('fecha', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('usuario', function ($row) {
                    return $row->user->name;
                })
                ->editColumn('proveedor', function ($row) {
                    return $row->proveedor->razon_social;
                })

                ->editColumn('status', function ($row) {
                    // Verifica el estado y devuelve un badge con el color adecuado
                    switch ($row->status) {
                        case 'pendiente':
                            return '<span class="badge badge-danger">Pendiente</span>';
                        case 'completado':
                            return '<span class="badge badge-success">Completado</span>';
                        default:
                            return '<span class="badge badge-secondary">' . $row->status . '</span>';
                    }
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        } else {
            return view('solicitudes.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        $requerimientos = Requerimiento::where('tipo', 'SOLICITUD')->where('status', 'SIN PROCESAR')->get();
        return view('solicitudes.create')->with('proveedores', $proveedores)->with('requerimientos', $requerimientos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Obtener el requerimiento




        // Crear la solicitud
        $now = Carbon::now();
        $solicitud = new Solicitud();
        $solicitud->fecha = $now;
        $solicitud->descripcion = $request->descripcion;
        $solicitud->uso = $request->uso;
        $solicitud->proveedor_id = $request->proveedor;
        $solicitud->creado_por = auth()->id();
        $solicitud->status = 'pendiente';
        $solicitud->save();



        $productos = is_string($request->productos) ? json_decode($request->productos, true) : $request->productos;

        // Debug the structure of productos
        // dd($productos); // Inspect the structure

        foreach ($productos as $productoData) {
            $a = json_decode($productoData, true);
            // Ensure productoData is treated as an array
            if (is_array($a)) {
                // Verify the keys exist before accessing them
                $nombre = $a['nombre'] ?? null;
                $cantidad = $a['cantidad'] ?? null;
                $precio = $a['precio'] ?? 0;

                // Debug to verify contents
                // dd($nombre, $cantidad); // Check what we're getting

                // Busca el producto en la base de datos
                $producto = Producto::where('nombre', $nombre)->first();

                // Crea una nueva instancia de ProductoOrdenado
                $productoOrdenado = new ProductoOrdenado();
                $productoOrdenado->fecha = now(); // Usa Carbon directamente para la fecha actual
                $productoOrdenado->cantidad = $cantidad;
                $productoOrdenado->producto_id = $producto ? $producto->id : null; // Maneja caso donde no se encuentra el producto
                $productoOrdenado->solicitud_id = $solicitud->id;
                $productoOrdenado->monto = $producto->aplica_iva ? $cantidad * $precio * 1.16 : $cantidad * $precio;
                // Guarda la instancia
                $productoOrdenado->precio = $precio;
                $productoOrdenado->save();
            } else {
                // If productoData is not an array, output an error
                dd("Error: productoData is not an array", $productoData);
            }
        }



        Alert::success('Exito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->route('solicitudes.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $solicitud = Solicitud::find($id);

        //  dd($solicitud->id);
        $productos = ProductoOrdenado::where('solicitud_id', $solicitud->id)->get();
        $proveedores = Proveedor::all();
        $requerimientos = Requerimiento::where('tipo', 'SOLICITUD')->where('status', 'SIN PROCESAR')->orWhere('id', $solicitud->requerimiento_id)->get();
        return view('solicitudes.edit')->with('proveedores', $proveedores)->with('requerimientos', $requerimientos)->with('solicitud', $solicitud)->with('productos', $productos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Buscar la solicitud por ID
        $solicitud = Solicitud::findOrFail($id);

        // Actualizar los campos principales de la solicitud
        $solicitud->proveedor_id = $request->input('proveedor');
        $solicitud->descripcion = $request->descripcion;
        $solicitud->uso = $request->uso;
        $solicitud->save();
       

        //dd($request->productos);
        // dd($request->productos);
        // Obtener los productos enviados en la solicitud (productos seleccionados en el formulario)
        $productosEnFormulario = is_string($request->productos) ? json_decode($request->productos, true) : $request->productos;

        // Obtener los productos actuales asociados a la solicitud
        $productosExistentes = ProductoOrdenado::where('solicitud_id', $solicitud->id)->get();

        // Guardar IDs de productos seleccionados en el formulario
        $productosIdsEnFormulario = [];

        // Actualizar o agregar productos
        foreach ($productosEnFormulario as $productoData) {
            $productoArray = json_decode($productoData, true);

            if (is_array($productoArray)) {
                $nombre = $productoArray['nombre'] ?? null;
                $cantidad = $productoArray['cantidad'] ?? null;
                $precio = $productoArray['precio'] ?? 0;

                // Buscar el producto en la base de datos por nombre
                $producto = Producto::where('nombre', $nombre)->first();

                if ($producto) {
                    // Guardar el producto_id en el array para la comparación posterior
                    $productosIdsEnFormulario[] = $producto->id;

                    // Verificar si el producto ya está en la solicitud
                    $productoExistente = ProductoOrdenado::where('solicitud_id', $solicitud->id)
                        ->where('producto_id', $producto->id)
                        ->first();

                    if ($productoExistente) {
                        // Si el producto ya existe en la solicitud, actualizar la cantidad
                        $productoExistente->cantidad = $cantidad;

                        $productoExistente->monto = ($producto->aplica_iva ?? 0) ? $cantidad * $precio * 1.16 : $cantidad * $precio;


                        // Guarda la instancia
                        $productoExistente->precio = $precio;
                        $productoExistente->save();
                    } else {
                        // Si el producto no existe en la solicitud, agregarlo
                        $nuevoProducto = new ProductoOrdenado();
                        $nuevoProducto->solicitud_id = $solicitud->id;
                        $nuevoProducto->producto_id = $producto->id;
                        $nuevoProducto->cantidad = $cantidad;
                        $nuevoProducto->monto = $producto->aplica_iva ? $cantidad * $precio * 1.16 : $cantidad * $precio;
                        // Guarda la instancia
                        $nuevoProducto->precio = $precio;
                        $nuevoProducto->fecha = now(); // Usamos Carbon para la fecha actual
                        $nuevoProducto->save();
                    }
                } else {
                    // Si el producto no se encuentra en la base de datos, manejar el error o crear un nuevo producto si es necesario
                    Alert::error('¡Error!', 'Producto no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
                }
            } else {
                // Si $productoData no es un array, mostrar un error
                Alert::error('¡Error!', 'Datos inválidos')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            }
        }

        // Eliminar productos que ya no están en la lista
        foreach ($productosExistentes as $productoExistente) {
            if (!in_array($productoExistente->producto_id, $productosIdsEnFormulario)) {
                // Eliminar el producto si ya no está en la nueva lista de productos seleccionados
                $productoExistente->delete();
            }
        }

        $productosOrdenados = ProductoOrdenado::where('solicitud_id', $solicitud->id)->get();
        if ($solicitud->status == 'pendiente' && $request->status == 'aprobado') {
            $solicitud->status = $request->status;
            $solicitud->save();
            foreach ($productosOrdenados as $productoAsignado) {
                $producto = Producto::find($productoAsignado->producto_id);
                $producto->cantidad += $productoAsignado->cantidad;
                $producto->save();
            }
        } else if ($solicitud->status == 'pendiente' && $request->status == 'cancelado') {
            $solicitud->status = $request->status;
            $solicitud->save();
        } else if ($solicitud->status == 'aprobado' && $request->status == 'cancelado') {
            $solicitud->status = $request->status;
            $solicitud->save();
            foreach ($productosOrdenados as $productoAsignado) {
                $producto = Producto::find($productoAsignado->producto_id);
                $producto->cantidad -= $productoAsignado->cantidad;
                $producto->save();
            }
        } else if ($solicitud->status == 'cancelado' && $request->status == 'aprobado') {
            Alert::error('Error!', 'Una solicitud rechazada no puede ser aprobada')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('solicitudes.index')->with('success', 'Erro al actualizar solicitud');
        }else if ($solicitud->status == 'cancelado' && $request->status == 'pendiente') {
            Alert::error('Error!', 'Una solicitud rechazada no puede pasar a pendiente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('solicitudes.index')->with('success', 'Erro al actualizar solicitud');
        }

        // Redireccionar después de actualizar la solicitud
        Alert::success('¡Éxito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente');
    }


    public function export(Request $request)
    {
        // Validate the date range
        if($request->end_date < $request->start_date){
            Alert::error('Consulta incongruente,', 'Ingrese un rango de fecha correcto')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente');
        }

        return Excel::download(new SolicitudesExport($request->start_date, $request->end_date), 'solicitudes.xlsx');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
