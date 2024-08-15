<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cantidad_talla extends Model
{
    protected $table = 'cantidad_talla';

    public $timestamps = false;

    protected $fillable = [
        'Id_producto',
        'talla1',
        'talla2',
        'talla3',
        'talla4',
        'talla5',
    ];
    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_producto', 'Id_producto');
    }
}
