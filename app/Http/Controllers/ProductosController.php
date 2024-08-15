<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Cantidad_talla;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    
}
