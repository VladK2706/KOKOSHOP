<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'ventas';

    // Clave primaria
    protected $primaryKey = 'Id_venta';

    // Los campos que se pueden asignar en masa
    protected $fillable = [
        'Id_cli',
        'Id_Emp',
        'precio_Total',
        'fecha_venta',
        'tipo_venta',
        'estado',
    ];

    // Relaciones

    /**
     * Relación con el modelo Usuario (Cliente).
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'Id_cli', 'id');
    }

    /**
     * Relación con el modelo Usuario (Empleado).
     */
    public function empleado()
    {
        return $this->belongsTo(User::class, 'Id_Emp', 'id');
    }

    /**
     * Relación con el modelo ProductoVenta.
     */
    public function productos()
    {
        return $this->hasMany(User::class, 'Id_venta', 'Id_venta');
    }
}
