<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VentasController;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function mostrarFormulario(Producto $producto)
    {
        // Obtener las tallas del producto
        $tallas = $producto->tallas()->pluck('talla');

        return view('compraFormulario', ['producto' => $producto, 'tallas' => $tallas]);
    }
}
