<?php

namespace App\Http\Controllers;

use App\Models\Cantidad_talla;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        /*
        $request->validate([
            'nombre' => ['required', 'string', 'max:30', 'min:10'],
            'precio' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'min:10000', 'max:300000'],
            'cantidad_total' => ['required', 'integer', 'max:30', 'min:1'],
            'tipo_prenda' => ['required', 'string', 'max:15', 'min:7']
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index');
        */
        // Validar los datos recibidos
        $validated = $request->validate([
            'produc_nom' => ['required', 'string', 'max:50'],
            'produc_precio' => ['required', 'numeric'],
            'talla1' => ['required', 'integer'],
            'talla2' => ['required', 'integer'],
            'talla3' => ['required', 'integer'],
            'talla4' => ['required', 'integer'],
            'talla5' => ['required', 'integer'],
        ]);

        DB::beginTransaction();

        try {
            // Inserción en la tabla productos
            $producto = Producto::create([
                'produc_nom' => $validated['produc_nom'],
                'produc_precio' => $validated['produc_precio'],
                'cantidad_total' => $validated['talla1'] + $validated['talla2'] + $validated['talla3'] + $validated['talla4'] + $validated['talla5'],
                'tipo_prenda' => $request->tipo_prenda, // Asegúrate de que esto se valida también
            ]);

            // Inserción en la tabla cantidad_talla
            Cantidad_talla::create([
                'Id_producto' => $producto->Id_producto, // ID del producto recién creado
                'talla1' => $validated['talla1'],
                'talla2' => $validated['talla2'],
                'talla3' => $validated['talla3'],
                'talla4' => $validated['talla4'],
                'talla5' => $validated['talla5'],
            ]);

            // Confirmar la transacción
            DB::commit();

            return redirect()->back()->with('success', 'Producto y cantidades por talla creados correctamente');

            return redirect()->route('productos.index');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            return redirect()->back()->with('error', 'Error al crear el producto: '.$e->getMessage());
        }
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', ['producto' => $producto]);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'produc_nom' => ['required', 'string', 'max:50'],
            'produc_precio' => ['required', 'numeric'],
            'talla1' => ['required', 'integer'],
            'talla2' => ['required', 'integer'],
            'talla3' => ['required', 'integer'],
            'talla4' => ['required', 'integer'],
            'talla5' => ['required', 'integer'],
        ]);

        DB::beginTransaction();

        try {

            // Encontrar el producto existente
            $producto = Producto::findOrFail($id);
            // Inserción en la tabla productos
            $producto->update([
                'produc_nom' => $validated['produc_nom'],
                'produc_precio' => $validated['produc_precio'],
                'cantidad_total' => $validated['talla1'] + $validated['talla2'] + $validated['talla3'] + $validated['talla4'] + $validated['talla5'],
                'tipo_prenda' => $request->tipo_prenda, // Asegúrate de que esto se valida también
            ]);

            // Encontrar la cantidad de tallas asociada
            $cantidadTalla = Cantidad_talla::where('Id_producto', $producto->Id_producto)->firstOrFail();

            // Inserción en la tabla cantidad_talla
            $cantidadTalla->update([
                'Id_producto' => $producto->Id_producto, // ID del producto recién creado
                'talla1' => $validated['talla1'],
                'talla2' => $validated['talla2'],
                'talla3' => $validated['talla3'],
                'talla4' => $validated['talla4'],
                'talla5' => $validated['talla5'],
            ]);

            // Confirmar la transacción
            DB::commit();

            return redirect()->back()->with('success', 'Producto y cantidades por talla Actualizados correctamente');

            return redirect()->route('productos.index');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            return redirect()->back()->with('error', 'Error al actualizar el producto: '.$e->getMessage());
        }
    }

    public function destroy($id)
{
    DB::beginTransaction();

    try {
        // Encontrar el producto existente
        $producto = Producto::findOrFail($id);

        // Eliminar las cantidades por talla asociadas
        Cantidad_talla::where('Id_producto', $producto->Id_producto)->delete();

        // Eliminar el producto
        $producto->delete();

        // Confirmar la transacción
        DB::commit();

        return redirect()->back()->with('success', 'Producto y cantidades por talla eliminados correctamente');
    } catch (\Exception $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();

        return redirect()->back()->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
    }
}
}
