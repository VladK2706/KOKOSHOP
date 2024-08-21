<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class CatalogoController extends Controller
{
    public function ver_productos()
    {
        $productos = Producto::where('cantidad_total', '>', 0)->get();

        return view('productos', compact('productos'));
    }

    public function ver_detalles_producto($id)
    {
        $producto = Producto::with('tallas')->find($id);
        
        return view('interfazProducto', ['producto' => $producto]);
    }
    
}
