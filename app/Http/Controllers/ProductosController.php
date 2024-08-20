<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CantidadTalla;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Show the list of products with their sizes and quantities
    public function index()
    {
        $productos = Producto::with('tallas')->get();
        return view('productos.index', compact('productos'));
    }

    // Show a single product with its sizes and quantities
    public function show($id)
    {
        $producto = Producto::with('tallas')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Show form to create a new product
    public function create()
    {
        return view('productos.create');
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|integer',
            'cantidad_total' => 'required|integer',
            'tipo_producto' => 'required|string|max:255',
            'nombre_imagen' => 'required|string|max:255',
            'tallas' => 'required|array',
            'tallas.*.talla' => 'required|string|max:255',
            'tallas.*.cantidad' => 'required|integer',
        ]);

        $producto = Producto::create($request->only([
            'nombre',
            'precio',
            'cantidad_total',
            'tipo_producto',
            'nombre_imagen',
        ]));

        foreach ($request->tallas as $talla) {
            CantidadTalla::create([
                'Id_producto' => $producto->Id_producto,
                'talla' => $talla['talla'],
                'cantidad' => $talla['cantidad'],
            ]);
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    // Show form to edit an existing product
    public function edit($id)
    {
        $producto = Producto::with('tallas')->findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // Update an existing product in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|integer',
            'cantidad_total' => 'required|integer',
            'tipo_producto' => 'required|string|max:255',
            'nombre_imagen' => 'required|string|max:255',
            'tallas' => 'required|array',
            'tallas.*.talla' => 'required|string|max:255',
            'tallas.*.cantidad' => 'required|integer',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->only([
            'nombre',
            'precio',
            'cantidad_total',
            'tipo_producto',
            'nombre_imagen',
        ]));

        $producto->tallas()->delete();

        foreach ($request->tallas as $talla) {
            CantidadTalla::create([
                'Id_producto' => $producto->Id_producto,
                'talla' => $talla['talla'],
                'cantidad' => $talla['cantidad'],
            ]);
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    // Delete a product and its associated sizes from the database
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
