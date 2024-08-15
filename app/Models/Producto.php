<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'Id_producto';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'precio',
        'cantidad_total',
        'tipo_prenda',
    ];

    public function cantidadTallas()
    {
        return $this->hasMany(Cantidad_talla::class, 'Id_producto', 'Id_producto');
    }

    public function actualizarCantidadTallas($Id_producto, $tallas)
    {
        $producto = Producto::find($Id_producto);
        $totalCantidad = 0;

        foreach ($tallas as $talla => $cantidad) {
            Cantidad_talla::updateOrCreate(
                ['Id_producto' => $Id_producto, 'talla' => $talla],
                ['cantidad' => $cantidad]
            );

            $totalCantidad += $cantidad;
        }

        // Actualiza la cantidad total en la tabla productos
        $producto->update(['cantidad_total' => $totalCantidad]);
    }
}
