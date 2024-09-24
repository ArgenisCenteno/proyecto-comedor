<?php

namespace App\Http\Controllers;

use App\Exports\AsignacionesExport;
use App\Models\Asignacion;
use App\Models\BeneficiarioAsignacion;
use App\Models\Personal;
use App\Models\Producto;
use App\Models\ProductoAsignado;
use App\Models\Proveedor;
use App\Models\Requerimiento;
use App\Models\Tramites;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Alert;
use Carbon\Carbon;
class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $solicitudes = Asignacion::with( 'creador')->get();
    
            return DataTables::of($solicitudes)
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('asignaciones.edit', [$row->id]) . '"  ><span class="material-icons">edit</span></a>
                        <form action="' . route('asignaciones.destroy', [$row->id]) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="border-0 bg-transparent p-0"><span class="material-icons text-danger">delete</span></button>
                        </form>';
                })
                ->editColumn('fecha', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('tipo', function ($row) {
                    return $row->tipo;
                })
               
                ->editColumn('creador', function ($row) {
                    return $row->creador->name;
                })
              
                ->editColumn('status', function ($row) {
                    // Verifica el estado y devuelve un badge con el color adecuado
                    switch ($row->status) {
                        case 'Pendiente':
                            return '<span class="badge badge-danger">Pendiente</span>';
                        case 'Aprobado':
                            return '<span class="badge badge-success">Aprobado</span>';
                        default:
                            return '<span class="badge badge-secondary">' . ucfirst($row->status) . '</span>';
                    }
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        } else {
            return view('asignaciones.index');
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personals = Proveedor::all();
        $requerimientos = Requerimiento::where('tipo', 'ASIGNACION')->where('status', 'SIN PROCESAR')->get();
        return view('asignaciones.create')->with('personals', $personals)->with('requerimientos', $requerimientos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //  dd("test");
    
       
        // Crear la asignacion
        $now = Carbon::now();
        $solicitud = new Asignacion();
        $solicitud->fecha = $now;
        $solicitud->descripcion = $request->descripcion;
        $solicitud->tipo = $request->tipo;
        $solicitud->creado_por = auth()->id();
        $solicitud->status = 'Pendiente';
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

                // Debug to verify contents
                // dd($nombre, $cantidad); // Check what we're getting

                // Busca el producto en la base de datos
                $producto = Producto::where('nombre', $nombre)->first();

                // Crea una nueva instancia de ProductoOrdenado
                $productoOrdenado = new ProductoAsignado();
                $productoOrdenado->fecha = now(); // Usa Carbon directamente para la fecha actual
                $productoOrdenado->cantidad = $cantidad;
                $productoOrdenado->producto_id = $producto ? $producto->id : null; // Maneja caso donde no se encuentra el producto
                $productoOrdenado->asignacion_id = $solicitud->id;

                // Guarda la instancia
                $productoOrdenado->save();

                if($productoOrdenado){
                    $producto->cantidad -= $cantidad;
                }
            } else {
                // If productoData is not an array, output an error
                dd("Error: productoData is not an array", $productoData);
            }
        }

        $proveedores = is_string($request->proveedores) ? json_decode($request->proveedores, true) : $request->proveedores;
        foreach ($proveedores as $productoData) {
            $a = json_decode($productoData, true);
            // Ensure productoData is treated as an array
            if (is_array($a)) {
                $nombre = $a['nombre'] ?? null;
                $rif = $a['rif'] ?? null;

                // Debug to verify contents
                // dd($nombre, $cantidad); // Check what we're getting

                // Busca el producto en la base de datos
                $proveedor = Proveedor::where('rif', $rif)->first();
                $b = new BeneficiarioAsignacion();
                $b->proveedor_id = $proveedor ? $proveedor->id : null; // Maneja caso donde no se encuentra el producto
                $b->asignacion_id = $solicitud->id;

                // Guarda la instancia
                $b->save();

            }
        }
       
        Alert::success('Exito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->route('asignaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { 
        $asignacion = Asignacion::find($id);

        //  dd($solicitud->id);
           $productos = ProductoAsignado::where('asignacion_id', $asignacion->id)->get();
           $proveedores = BeneficiarioAsignacion::where('asignacion_id', $asignacion->id)->get();
           $personal = Personal::all();
           $requerimientos = Requerimiento::where('tipo', 'ASIGNACION')->where('status', 'SIN PROCESAR')->orWhere('id', $asignacion->requerimiento_id)->get();
           return view('asignaciones.edit')->with('proveedores', $proveedores)->with('personals', $personal)->with('requerimientos', $requerimientos)->with('asignacion', $asignacion)->with('productos', $productos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Buscar la solicitud por ID
        $solicitud = Asignacion::findOrFail($id);
    
        // Actualizar los campos principales de la solicitud
        $solicitud->descripcion = $request->input('descripcion');
        $solicitud->tipo = $request->tipo;
        $solicitud->save();
    
        // Obtener los productos enviados en la solicitud (productos seleccionados en el formulario)
        $productosEnFormulario = is_string($request->productos) ? json_decode($request->productos, true) : $request->productos;
        $proveedoresEnFormulario = is_string($request->proveedores) ? json_decode($request->proveedores, true) : $request->proveedores;
        // Obtener los productos actuales asociados a la solicitud
        $productosExistentes = ProductoAsignado::where('asignacion_id', $solicitud->id)->get();
        $proveedoresExistentes = BeneficiarioAsignacion::where('asignacion_id', $solicitud->id)->get();
        // Guardar IDs de productos seleccionados en el formulario
        $productosIdsEnFormulario = [];
      
    
        // Actualizar o agregar productos
        foreach ($productosEnFormulario as $productoData) {
            $productoArray = json_decode($productoData, true);
    
            if (is_array($productoArray)) {
                $nombre = $productoArray['nombre'] ?? null;
                $cantidad = $productoArray['cantidad'] ?? null;
    
                // Buscar el producto en la base de datos por nombre
                $producto = Producto::where('nombre', $nombre)->first();
    
                if ($producto) {
                    // Guardar el producto_id en el array para la comparación posterior
                    $productosIdsEnFormulario[] = $producto->id;
    
                    // Verificar si el producto ya está en la solicitud
                    $productoExistente = ProductoAsignado::where('asignacion_id', $solicitud->id)
                        ->where('producto_id', $producto->id)
                        ->first();
    
                    if ($productoExistente) {
                        // Si el producto ya existe en la solicitud, actualizar la cantidad
                        $productoExistente->cantidad = $cantidad;
                        $productoExistente->save();
                    } else {
                        // Si el producto no existe en la solicitud, agregarlo
                        $nuevoProducto = new ProductoAsignado();
                        $nuevoProducto->asignacion_id = $solicitud->id;
                        $nuevoProducto->producto_id = $producto->id;
                        $nuevoProducto->cantidad = $cantidad;
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
        $proveedoresIdsEnFormulario = [];
      
        foreach ($proveedoresEnFormulario as $productoData) {
            $productoArray = json_decode($productoData, true);

            if (is_array($productoArray)) {
                $nombre = $productoArray['nombre'] ?? null;
                $rif = $productoArray['rif'] ?? null;
    
                // Buscar el producto en la base de datos por nombre
                $proveedor = Proveedor::where('rif', $rif)->first();
                
    
                if ($proveedor) {
                    // Guardar el producto_id en el array para la comparación posterior
                    $proveedoresIdsEnFormulario[] = $proveedor->id;
    
                    // Verificar si el producto ya está en la solicitud
                    $proveedorExistente = BeneficiarioAsignacion::where('proveedor_id', $proveedor->id)
                      
                        ->first();
    
                    if (!$proveedorExistente) {
                        // Si el producto no existe en la solicitud, agregarlo
                        $nuevoBeneficiario = new BeneficiarioAsignacion();
                        $nuevoBeneficiario->asignacion_id = $solicitud->id;
                        $nuevoBeneficiario->proveedor_id = $proveedor->id;
                        $nuevoBeneficiario->save();
                    }
                } else {
                    // Si el producto no se encuentra en la base de datos, manejar el error o crear un nuevo producto si es necesario
                    Alert::error('¡Error!', 'Proveedor no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
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

        foreach ($proveedoresExistentes as $proveedorExistente) {
            if (!in_array($proveedorExistente->proveedor_id, $productosIdsEnFormulario)) {
                // Eliminar el producto si ya no está en la nueva lista de productos seleccionados
                $proveedorExistente->delete();
            }
        }

        $productosOrdenados = ProductoAsignado::where('asignacion_id', $solicitud->id)->get();
        if ($solicitud->status == 'Pendiente' && $request->status == 'Aprobado') {
            $solicitud->status = $request->status;
            $solicitud->save();
            foreach ($productosOrdenados as $productoAsignado) {
                $producto = Producto::find($productoAsignado->producto_id);
                $producto->cantidad -= $productoAsignado->cantidad;
                $producto->save();
            }
        } else if ($solicitud->status == 'Pendiente' && $request->status == 'Cancelado') {
            $solicitud->status = $request->status;
            $solicitud->save();
        } else if ($solicitud->status == 'Aprobado' && $request->status == 'Aprobado') {
            Alert::error('Error!', 'No se puede aprobar una asignación más de una vez')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('asignaciones.index')->with('success', 'Erro al actualizar solicitud');
        } else if ($solicitud->status == 'Aprobado' && $request->status == 'Cancelado') {
            $solicitud->status = $request->status;
            $solicitud->save();
            foreach ($productosOrdenados as $productoAsignado) {
                $producto = Producto::find($productoAsignado->producto_id);
                $producto->cantidad += $productoAsignado->cantidad;
                $producto->save();
            }
        } else if ($solicitud->status == 'cancelado' && $request->status == 'aprobado') {
            Alert::error('Error!', 'Una Asignación rechazada no puede ser aprobada')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('asignaciones.index')->with('success', 'Erro al actualizar solicitud');
        }else if ($solicitud->status == 'cancelado' && $request->status == 'pendiente') {
            Alert::error('Error!', 'Una Asignación rechazada no puede pasar a pendiente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('asignaciones.index')->with('success', 'Erro al actualizar solicitud');
        }
    
        // Redireccionar después de actualizar la solicitud
        Alert::success('¡Éxito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
        return redirect()->route('asignaciones.index')->with('success', 'Solicitud actualizada correctamente');
    }
    
    
    public function export(Request $request)
    {
        if($request->end_date < $request->start_date){
            Alert::error('Consulta incongruente,', 'Ingrese un rango de fecha correcto')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
            return redirect()->route('asignaciones.index')->with('success', 'Solicitud actualizada correctamente');
        }
        // Validate the date range
       

        return Excel::download(new AsignacionesExport($request->start_date, $request->end_date), 'asignaciones.xlsx');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
