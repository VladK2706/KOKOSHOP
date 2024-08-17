@extends('layouts.app')
@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Modificar Usuario</h2>
            <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
            <div class="card-body">
                <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $usuario->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Apellido') }}</label>

                        <div class="col-md-6">
                            <input id="lastname" type="text"
                                class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                value="{{ $usuario->lastname }}" required autocomplete="lastname">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="id_rol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                        <div class="col-md-6">

                            <select id="id_rol" class="form-control @error('id_rol') is-invalid @enderror" name="id_rol"
                                value="{{ old('id_rol') }}" required autocomplete="id_rol">
                                <option value="{{ $usuario->id_rol }}" selected>
                                    @if ($usuario->id_rol == 1)
                                        Admin
                                    @elseif ($usuario->id_rol == 2)
                                        Cliente
                                    @elseif ($usuario->id_rol == 3)
                                        Vendedor
                                    @elseif ($usuario->id_rol == 4)
                                        Almacenista
                                    @endif
                                </option>
                                <option value="1">Admin</option>
                                <option value="2">Cliente</option>
                                <option value="3">Vendedor</option>
                                <option value="4">Almacenista</option>
                            </select>

                            @error('id_rol')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tipo_doc"
                            class="col-md-4 col-form-label text-md-end">{{ __('Tipo de Documento') }}</label>

                        <div class="col-md-6">

                            <select id="tipo_doc" class="form-control @error('tipo_doc') is-invalid @enderror"
                                name="tipo_doc" value="{{ old('tipo_doc') }}" required autocomplete="tipo_doc">
                                <option value="{{ $usuario->tipo_doc }}" selected>
                                    @if ($usuario->tipo_doc == 'CC')
                                        Cédula de ciudadania
                                    @elseif ($usuario->tipo_doc == 'TI')
                                        Tarjeta de Identidad
                                    @elseif ($usuario->tipo_doc == 'CE')
                                        Cédula de Extranjeria
                                    @elseif ($usuario->tipo_doc == 'PEP')
                                        Permiso Especial de Permanencia
                                    @elseif ($usuario->tipo_doc == 'DIE')
                                        Documento de identificación extranjero
                                    @endif
                                </option>
                                <option value="CC">Cédula de ciudadania</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjeria</option>
                                <option value="PEP">Permiso Especial de Permanencia</option>
                                <option value="DIE">Documento de identificación extranjero</option>
                            </select>

                            @error('tipo_doc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="num_doc"
                            class="col-md-4 col-form-label text-md-end">{{ __('Número de Documento') }}</label>

                        <div class="col-md-6">
                            <input id="num_doc" type="Number" class="form-control @error('num_doc') is-invalid @enderror"
                                name="num_doc" value="{{ $usuario->num_doc }}" required autocomplete="num_doc">

                            @error('num_doc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ciudad" class="col-md-4 col-form-label text-md-end">{{ __('Ciudad') }}</label>

                        <div class="col-md-6">

                            <select id="ciudad" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad"
                                value="{{ old('ciudad') }}" required autocomplete="ciudad">
                                <option value="{{ $usuario->ciudad }}" selected>{{ $usuario->ciudad }}</option>
                                <option value="Bogotá D.C.">Bogotá D.C.</option>
                                <option value="Medellín">Medellín</option>
                                <option value="Cali">Cali</option>
                                <option value="Barranquilla">Barranquilla</option>
                                <option value="Cartagena">Cartagena</option>
                                <option value="Bucaramanga">Bucaramanga</option>
                                <option value="Pereira">Pereira</option>
                                <option value="Manizales">Manizales</option>
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Ibagué">Ibagué</option>
                                <option value="Cúcuta">Cúcuta</option>
                                <option value="Villavicencio">Villavicencio</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Neiva">Neiva</option>
                                <option value="Popayán">Popayán</option>
                                <option value="Valledupar">Valledupar</option>
                                <option value="Pasto">Pasto</option>
                                <option value="Montería">Montería</option>
                                <option value="Quibdó">Quibdó</option>
                                <option value="Tunja">Tunja</option>
                            </select>

                            @error('ciudad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="direccion" class="col-md-4 col-form-label text-md-end">{{ __('Dirección') }}</label>

                        <div class="col-md-6">
                            <input id="direccion" type="text"
                                class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                value="{{ $usuario->direccion }}" required autocomplete="direccion">

                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="telefono"
                            class="col-md-4 col-form-label text-md-end">{{ __('Número de Teléfono') }}</label>

                        <div class="col-md-6">
                            <input id="telefono" type="Number"
                                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                value="{{ $usuario->telefono }}" required autocomplete="telefono">

                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-end">{{ __('Correo Electronico') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $usuario->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!--
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
    @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>
                        </div>
                    -->
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
