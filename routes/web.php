<?php

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::resource('usuarios', UserController::class);
    Route::resource('productos', ProductosController::class);
    Route::resource('ventas', VentasController::class);

});
Route::get('/catalogo', [CatalogoController::class, 'ver_productos'])->name('catalogo.ver');
