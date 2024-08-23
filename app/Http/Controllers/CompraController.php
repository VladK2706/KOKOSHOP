<?php

namespace App\Http\Controllers;

use App\Models\CantidadTalla;
use App\Models\Producto;
use App\Models\ProductosVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function mostrarFormulario(Request $request)
    {
        $productoId = $request->input('Id_producto');
        $tallaId = $request->input('tallaId');

        $tallaName = CantidadTalla::where('id', $tallaId)->first(); // Usar first() para obtener un objeto

        if (! $tallaName) {
            // Manejar el caso donde la talla no se encuentra
            return redirect()->back()->withErrors('Talla no encontrada');
        }

        $cantidad = $request->input('talla_cantidad');

        // Aquí puedes buscar el producto, la talla, y realizar las validaciones o el procesamiento necesario

        // Ejemplo: Buscar el producto
        $producto = Producto::find($productoId);

        // Puedes realizar la lógica de compra aquí o redirigir a otra función para procesar la compra
        // return view('compraFormulario', compact('producto', 'talla', 'cantidad'));

        // Redirigir con datos si lo deseas


        return view('compraFormulario', compact('producto', 'tallaId', 'tallaName', 'cantidad'));
    }

    public function realizarCompra(Request $request)
    {
        $validated = $request->validate([
            'Id_cli' => ['required', 'exists:users,id'],
            'Id_Emp' => ['required', 'exists:users,id'],

            'fecha_venta' => ['required', 'date', 'date_format:Y-m-d'],
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
        
    
        //dd($request->all());
        $productosDetallados = [];
        foreach ($validated['productos'] as $productoData) {
            $producto = Producto::find($productoData['Id_producto']);
            $productosDetallados[] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $productoData['cantidad_producto'],
                'talla' => $productoData['talla_producto'],
                'subtotal' => $producto->precio * $productoData['cantidad_producto']
            ];
        }
        
        return view('compraRealizada', compact('venta', 'productosDetallados'));

    }
}
