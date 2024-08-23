<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $this->guard()->logout();

        return '/login';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'tipo_doc' => $data['tipo_doc'],
            'num_doc' => $data['num_doc'],
            'ciudad' => $data['ciudad'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
