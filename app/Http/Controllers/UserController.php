<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'lastname' => ['required', 'string', 'max:20'],
            'id_rol' => ['required', 'int'],
            'tipo_doc' => ['required', 'string', 'max:5'],
            'num_doc' => ['required', 'int'],
            'ciudad' => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:30'],
            'telefono' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create($request->all());

        return redirect()->route('usuarios.index');
    }

    public function edit(User $usuario)
    {
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'lastname' => ['required', 'string', 'max:20'],
            'id_rol' => ['required', 'int'],
            'tipo_doc' => ['required', 'string', 'max:5'],
            'num_doc' => ['required', 'int'],
            'ciudad' => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:30'],
            'telefono' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index');
    }
}
