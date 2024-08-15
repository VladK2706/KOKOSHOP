<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cantidad_talla extends Model
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
