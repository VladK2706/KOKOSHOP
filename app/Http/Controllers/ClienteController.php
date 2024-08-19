<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = User::where('id_rol', 2)->get(); // Ejemplo: Obtener todos los usuarios con el rol de cliente
        $productos = Producto::where('cantidad_total', '>', 0);

        // Retornar la vista con los clientes
        return view('cliente.index', compact('clientes', 'productos'));
    }

}
