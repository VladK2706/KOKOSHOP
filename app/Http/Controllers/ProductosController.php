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
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:30', 'min:5'],
            'precio' => ['required', 'integer'],
            'tipo_producto' => ['required', 'string', 'max:16', 'min:6'],
            'talla1' => ['required', 'integer'],
            'talla2' => ['required', 'integer'],
            'talla3' => ['required', 'integer'],
            'talla4' => ['required', 'integer'],
            'talla5' => ['required', 'integer'],
        ]);

        DB::beginTransaction();

        // Inserción en la tabla productos
        $producto = Producto::create([
            'nombre' => $validated['nombre'],
            'precio' => $validated['precio'],
            'tipo_producto' => $request->tipo_producto, // Asegúrate de que esto se valida también
            'cantidad_total' => $validated['talla1'] + $validated['talla2'] + $validated['talla3'] + $validated['talla4'] + $validated['talla5'],
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

        return redirect()->route('productos.index');

        /*
        try {
            // Inserción en la tabla productos
            $producto = Producto::create([
                'nombre' => $validated['nombre'],
                'precio' => $validated['precio'],
                'tipo_producto' => $request->tipo_prenda, // Asegúrate de que esto se valida también
                'cantidad_total' => $validated['talla1'] + $validated['talla2'] + $validated['talla3'] + $validated['talla4'] + $validated['talla5'],
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


            return redirect()->route('productos.index');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            return redirect()->back()->with('error', 'Error al crear el producto: '.$e->getMessage());
        }
            */
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', ['producto' => $producto]);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:30', 'min:10'],
            'precio' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'min:10000', 'max:300000'],
            'tipo_producto' => ['required', 'string', 'max:16', 'min:6'],
            'talla1' => ['required', 'integer', 'min:0', 'max:20'],
            'talla2' => ['required', 'integer', 'min:0', 'max:20'],
            'talla3' => ['required', 'integer', 'min:0', 'max:20'],
            'talla4' => ['required', 'integer', 'min:0', 'max:20'],
            'talla5' => ['required', 'integer', 'min:0', 'max:20'],
        ]);

        DB::beginTransaction();

        try {

            // Encontrar el producto existente
            $producto = Producto::findOrFail($id);
            // Inserción en la tabla productos
            $producto->update([
                'nombre' => $validated['produc_nom'],
                'nombre' => $validated['produc_precio'],
                'cantidad_total' => $validated['talla1'] + $validated['talla2'] + $validated['talla3'] + $validated['talla4'] + $validated['talla5'],
                'tipo_producto' => $request->tipo_prenda, // Asegúrate de que esto se valida también
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

            return redirect()->back()->with('error', 'Error al eliminar el producto: '.$e->getMessage());
        }
    }
}
