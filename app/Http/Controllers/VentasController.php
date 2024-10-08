<?php

namespace App\Http\Controllers;

use App\Models\CantidadTalla;
use App\Models\Producto;
use App\Models\ProductosVenta;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    /**
     * Mostrar una lista de ventas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::with('cliente', 'empleado', 'productos')->get();

        return view('ventas.index', compact('ventas'));
    }

    /**
     * Mostrar el formulario para crear una nueva venta.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = User::where('Id_rol', 2)->get();
        $empleados = User::where('Id_rol', 1)->orWhere('Id_rol', 3)->get();
        $productos = Producto::where('cantidad_total', '>', 0)->get();

        // Obtener las tallas de cada producto
        $tallasPorProducto = [];
        foreach ($productos as $producto) {
            $tallasPorProducto[$producto->Id_producto] = $producto->tallas->pluck('talla')->toArray();
        }

        return view('ventas.create', compact('clientes', 'empleados', 'productos', 'tallasPorProducto'));
    }

    /**
     * Almacenar una venta recién creada en la base de datos.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validar los datos recibidos
        $validated = $request->validate([
            'Id_cli' => ['required', 'exists:users,id'],
            'Id_Emp' => ['required', 'exists:users,id'],

            'fecha_venta' => ['required', 'date'],
            'tipo_venta' => ['required', 'string', 'max:40'],
            'estado' => ['required', 'string', 'max:10'],
            'productos' => ['required', 'array'],
            'productos.*.Id_producto' => ['required', 'exists:productos,Id_producto'],
            'productos.*.cantidad_producto' => ['required', 'integer'],
            'productos.*.talla_producto' => ['nullable', 'string', 'max:16'],
        ]);

        DB::beginTransaction();

        $precionTotal = 0;

        if ($validated['tipo_venta'] == 'Virtual') {
            $precionTotal = 17000;
        }
        foreach ($request->productos as $producto) {
            $productoInfo = Producto::find($producto['Id_producto']);
            $precionTotal += $productoInfo->precio * $producto['cantidad_producto'];
        }

        // Crear la venta
        $venta = Venta::create([
            'Id_cli' => $validated['Id_cli'],
            'Id_Emp' => $validated['Id_Emp'],
            'precio_Total' => $precionTotal,
            'fecha_venta' => $validated['fecha_venta'],
            'tipo_venta' => $validated['tipo_venta'],
            'estado' => $validated['estado'],
        ]);

        // Insertar los productos de la venta

        foreach ($validated['productos'] as $productoData) {
            ProductosVenta::create([
                'Id_venta' => $venta->Id_venta,
                'Id_producto' => $productoData['Id_producto'],
                'cantidad_producto' => $productoData['cantidad_producto'],
                'talla_producto' => $productoData['talla_producto'],
            ]);
            $cantidadTalla = CantidadTalla::where('Id_producto', $productoData['Id_producto'])
                ->where('talla', $productoData['talla_producto'])
                ->first(); // Usar first() en lugar de get()

            // Verificar si se encontró el registro antes de proceder
            if ($cantidadTalla) {
                // Calcular la nueva cantidad
                $cantidadTallaTotal = $cantidadTalla->cantidad - $productoData['cantidad_producto'];

                // Actualizar la cantidad en la base de datos
                $cantidadTalla->update([
                    'cantidad' => $cantidadTallaTotal,
                ]);
            }

        }

        DB::commit();

        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');

    }

    /**
     * Mostrar los detalles de una venta específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::with('cliente', 'empleado', 'productos')->findOrFail($id);

        return view('ventas.show', compact('venta'));
    }

    /**
     * Mostrar el formulario para editar una venta existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::with('productos')->findOrFail($id);

        return view('ventas.edit', compact('venta'));
    }

    /**
     * Actualizar una venta existente en la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'Id_cli' => ['required', 'exists:users,id'],
            'Id_Emp' => ['required', 'exists:users,id'],
            'precio_Total' => ['required', 'numeric'],
            'fecha_venta' => ['required', 'date'],
            'tipo_venta' => ['required', 'string', 'max:40'],
            'estado' => ['required', 'string', 'max:10'],
            'productos' => ['required', 'array'],
            'productos.*.Id_producto' => ['required', 'exists:productos,Id_producto'],
            'productos.*.cantidad_producto' => ['required', 'integer'],
            'productos.*.talla_producto' => ['nullable', 'string', 'max:16'],
        ]);

        DB::beginTransaction();

        try {
            // Encontrar la venta existente
            $venta = Venta::findOrFail($id);
            $venta->update([
                'Id_cli' => $validated['Id_cli'],
                'Id_Emp' => $validated['Id_Emp'],
                'precio_Total' => $validated['precio_Total'],
                'fecha_venta' => $validated['fecha_venta'],
                'tipo_venta' => $validated['tipo_venta'],
                'estado' => $validated['estado'],
            ]);

            // Eliminar los productos existentes de la venta
            ProductosVenta::where('Id_venta', $id)->delete();

            // Insertar los productos actualizados
            foreach ($validated['productos'] as $productoData) {
                ProductosVenta::create([
                    'Id_venta' => $venta->Id_venta,
                    'Id_producto' => $productoData['Id_producto'],
                    'cantidad_producto' => $productoData['cantidad_producto'],
                    'talla_producto' => $productoData['talla_producto'],
                ]);
            }

            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Ocurrió un error al actualizar la venta.');
        }
    }

    /**
     * Eliminar una venta específica de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // Eliminar los productos asociados a la venta
            ProductosVenta::where('Id_venta', $id)->delete();

            // Eliminar la venta
            Venta::destroy($id);

            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Ocurrió un error al eliminar la venta.');
        }
    }
}
