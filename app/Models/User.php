<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'id_rol',
        'tipo_doc',
        'num_doc',
        'ciudad',
        'direccion',
        'telefono',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con el modelo Venta como cliente.
     */
    public function ventasComoCliente()
    {
        return $this->hasMany(Venta::class, 'Id_cli', 'id');
    }

    /**
     * Relación con el modelo Venta como empleado.
     */
    public function ventasComoEmpleado()
    {
        return $this->hasMany(Venta::class, 'Id_Emp', 'id');
    }
}
