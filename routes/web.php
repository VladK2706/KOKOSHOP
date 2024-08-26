<?php

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::resource('usuarios', UserController::class);
    Route::resource('productos', ProductosController::class);
    Route::resource('ventas', VentasController::class);

    //Route::post('/compra/{producto}', [CompraController::class, 'mostrarFormulario'])->name('compra.formulario');
    Route::get('/compraFormulario', [CompraController::class, 'mostrarFormulario'])->name('compraFormulario');
    Route::post('/compraRealizada', [CompraController::class, 'realizarCompra'])->name('reciboCompra');
    Route::get('/vendedor', [VendedorController::class, 'VentaFormulario'])->name('ventaFormulario');
    // Otras rutas...

});
Route::get('/catalogo', [CatalogoController::class, 'ver_productos'])->name('catalogo.ver');
Route::get('/interfazProducto/{id}', [CatalogoController::class, 'ver_detalles_producto'])->name('producto.ver');

Route::get('/nosotros', [ClienteController::class, 'nosotros'])->name('nosotros.ver');
Route::get('/asesoria', [ClienteController::class, 'asesoria'])->name('asesoria.ver');
