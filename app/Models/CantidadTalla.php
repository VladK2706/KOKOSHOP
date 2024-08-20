<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CantidadTalla extends Model
{
    protected $table = 'cantidad_talla';

    public $timestamps = false;

    protected $fillable = [
        'Id_producto',
        'talla',
        'cantidad',

    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_producto', 'Id_producto');
    }
}
