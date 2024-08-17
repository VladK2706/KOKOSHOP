<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosVenta extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'productos_venta';

    // Los campos que se pueden asignar en masa
    protected $fillable = [
        'Id_venta',
        'Id_producto',
        'cantidad_producto',
        'talla_producto',
    ];

    // Relaciones

    /**
     * Relación con el modelo Venta.
     */
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'Id_venta', 'Id_venta');
    }

    /**
     * Relación con el modelo Producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_producto', 'Id_producto');
    }

    public function ventas()
    {
        return $this->hasMany(ProductosVenta::class, 'Id_producto', 'Id_producto');
    }
}
