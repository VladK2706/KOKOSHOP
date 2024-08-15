<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:30', 'min:10'],
            'precio' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'min:10000', 'max:300000'],
            'cantidad_total' => ['required', 'integer', 'max:30', 'min:1'],
            'tipo_prenda' => ['required', 'string', ''],
        ]);
    }
}
