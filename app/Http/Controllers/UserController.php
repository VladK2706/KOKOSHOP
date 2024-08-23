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
           'name' => [
                'required',
                'string',
                'max:20',
                'min:3',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
                'unique:users,name',
            ],
            'lastname' => [
                'required',
                'string',
                'max:20',
                'min:3',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            ],
            'tipo_doc' => [
                'required',
                'string',
                'max:5',
                'in:CC,CE,PEP,DIE', // Example document types (could be customized)
            ],
            'num_doc' => [
                'required',
                'digits_between:5,10',
                'numeric',
                'unique:users,num_doc',
            ],
            'ciudad' => [
                'required',
                'string',
                'max:20',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            ],
            'direccion' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s,.#-]+$/',
            ],
            'telefono' => [
                'required',
                'string', 
                'size:10', 
                
                'unique:users,telefono',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'confirmed',
            ],
        ], [
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'lastname.regex' => 'El apellido solo puede contener letras y espacios.',
            'direccion.regex' => 'La dirección contiene caracteres inválidos.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 10 dígitos.',
            'password.regex' => 'La contraseña debe tener al menos una mayúscula, una minúscula, un número, y un carácter especial.',
            'num_doc.unique' => 'El número de documento ya está registrado.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',
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
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
