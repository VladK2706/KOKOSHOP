@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Usuarios</h2>
        <div class="title-crud">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Agregar Usuario</a>
        </div>
        @if (sizeof($users) > 0)
            <table class="table">
                <thead>
                    <th>Número de documento</th>
                    <th>Tipo de documento</th>
                    <th>Rol</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th class="text-center">Opciones</th>
                </thead>
                <tbody>
                    @foreach ($users as $usuario)
                        <tr>
                            <td>{{ $usuario->num_doc }}</td>
                            <td>
                                @if ($usuario->tipo_doc == 'CC')
                                    CC
                                @elseif ($usuario->tipo_doc == 'TI')
                                    TI
                                @elseif ($usuario->tipo_doc == 'CE')
                                    CE
                                @elseif ($usuario->tipo_doc == 'PEP')
                                    PEP
                                @elseif ($usuario->tipo_doc == 'DIE')
                                    DIE
                                @endif
                            </td>
                            <td>
                                @if ($usuario->id_rol == 1)
                                    Admin
                                @elseif($usuario->id_rol == 2)
                                    Cliente
                                @elseif($usuario->id_rol == 3)
                                    Vendedor
                                @elseif($usuario->id_rol == 4)
                                    Almacenista
                                @endif
                            </td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->lastname }}</td>
                            <td>{{ $usuario->ciudad }}</td>
                            <td>{{ $usuario->direccion }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-success">Editar</a>
                                <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('¿Esta seguro de elminar el usuario?')">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-secondary">No se encontraron registros</div>
        @endif
    </div>
@endsection
