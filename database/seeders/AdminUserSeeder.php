<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder; // O el modelo que estés usando para usuarios
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Cambia el email por el que desees
            [
                'name' => 'Super',
                'lastname' => 'Admin',
                'id_rol' => 1,
                'tipo_doc' => 'CC',
                'num_doc' => 1,
                'ciudad' => ' ',
                'direccion' => ' ',
                'telefono' => ' ',
                'password' => Hash::make('1234567890'), // Cambia la contraseña por una segura
            ]
        );
    }
}
