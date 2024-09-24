<?php

use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->away('login');
})->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
/* ALMACEN DE PRODUCTOS */
Route::get('/inventario', [ProductoController::class, 'almacen'])->name('inventario');
Route::post('/registrar-producto', [ProductoController::class, 'store'])->name('registrar-producto');
Route::resource('productos', App\Http\Controllers\ProductoController::class);
Route::get('/imagenes/{id}', [ProductoController::class, 'imagenesProducto'])->name('imagenes-producto');
Route::delete('/removerImagen/{id}', [ProductoController::class, 'removerImagen'])->name('removerImagen');
Route::post('/agregarImagen/{id}', [ProductoController::class, 'agregarImagen'])->name('agregarImagen');

/* CATEGORIAS Y SUBCATEGORIAS*/
Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
Route::resource('subcategorias', App\Http\Controllers\SubCategoriaController::class);

/* CAJAS */
Route::resource('cajas', App\Http\Controllers\CajaController::class);
Route::get('/aperturar/{id}', [CajaController::class, 'aperturarCaja'])->name('cajas.aperturar');
Route::post('/registrarApertura/{id}', [CajaController::class, 'registrarApertura'])->name('cajas.registrarApertura');

/* VENTAS */
Route::resource('ventas', App\Http\Controllers\VentaController::class);
Route::get('/vender', [VentaController::class, 'vender'])->name('ventas.vender');
Route::get('/datatableProductoVenta', [VentaController::class, 'datatableProductoVenta'])->name('ventas.datatableProductoVenta');
Route::post('/generarVenta', [VentaController::class, 'generarVenta'])->name('ventas.generarVenta');

// Ruta para obtener un producto por su ID
Route::get('/producto/{id}', [VentaController::class, 'obtenerProducto'])->name('productos.obtener');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* PROVEEDORES */
Route::resource('proveedores', App\Http\Controllers\ProveedorController::class);
Route::get('/buscarProveedores', [ProveedorController::class, 'buscarProveedor'])->name('buscarProductos');
Route::post('/import-proveedores', [ProveedorController::class, 'import'])->name('import.proveedores');
Route::get('export-proveedores', [ProveedorController::class, 'exportProveedores'])->name('export.proveedores');

/* PERSONAL */
Route::resource('personal', App\Http\Controllers\PersonalController::class);

/*Requerimiento*/
Route::resource('requerimientos', App\Http\Controllers\RequerimientoController::class);

/* TRAMITES */
Route::resource('tramites', App\Http\Controllers\TramiteController::class);
/* USERS */
Route::resource('usuarios', App\Http\Controllers\UserController::class);
/* Solicitud */
Route::resource('solicitudes', App\Http\Controllers\SolicitudController::class);
Route::resource('asignaciones', App\Http\Controllers\AsignacionController::class);
Route::post('/asignaciones/export', [AsignacionController::class, 'export'])->name('asignaciones.export');
Route::post('/solicitudes/export', [SolicitudController::class, 'export'])->name('solicitudes.export');

Route::get('/buscarProductos', [ProductoController::class, 'buscarProducto'])->name('buscarProductos');
Route::get('/exportar-productos', function () {
    return Excel::download(new ProductosExport, 'productos.xlsx');
});
Route::post('/productos/import', [ProductoController::class, 'import'])->name('productos.import');


/* TASAS, MONEDAS E IMPUESTOS */
Route::resource('tasas', App\Http\Controllers\TasasController::class);
});

/* COMPRAS */
Route::resource('compras', App\Http\Controllers\CompraController::class);
Route::get('/comprar', [CompraController::class, 'comprar'])->name('compras.comprar');
Route::get('/datatableProductoCompra', [CompraController::class, 'datatableProductoCompras'])->name('compras.datatableProductoCompra');
Route::post('/generarCompra', [CompraController::class, 'generarCompra'])->name('compras.generarCompra');



// Ruta de inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes();

