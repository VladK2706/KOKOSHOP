@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Apellido') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="lastname">

                                    @error('lastname')
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
                                        <option value="" selected>Selecionar</option>
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
                                    <input id="num_doc" type="Number"
                                        class="form-control @error('num_doc') is-invalid @enderror" name="num_doc"
                                        value="{{ old('num_doc') }}" required autocomplete="num_doc">

                                    @error('num_doc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ciudad"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Ciudad') }}</label>

                                <div class="col-md-6">

                                    <select id="ciudad" class="form-control @error('ciudad') is-invalid @enderror"
                                        name="ciudad" value="{{ old('ciudad') }}" required autocomplete="ciudad">
                                        <option value="" selected>Selecionar</option>
                                        <option value="bogota">Bogotá D.C.</option>
                                        <option value="medellin">Medellín</option>
                                        <option value="cali">Cali</option>
                                        <option value="barranquilla">Barranquilla</option>
                                        <option value="cartagena">Cartagena</option>
                                        <option value="bucaramanga">Bucaramanga</option>
                                        <option value="pereira">Pereira</option>
                                        <option value="manizales">Manizales</option>
                                        <option value="santa_marta">Santa Marta</option>
                                        <option value="ibague">Ibagué</option>
                                        <option value="cucuta">Cúcuta</option>
                                        <option value="villavicencio">Villavicencio</option>
                                        <option value="armenia">Armenia</option>
                                        <option value="neiva">Neiva</option>
                                        <option value="popayan">Popayán</option>
                                        <option value="valledupar">Valledupar</option>
                                        <option value="pasto">Pasto</option>
                                        <option value="monteria">Montería</option>
                                        <option value="quibdo">Quibdó</option>
                                        <option value="tunja">Tunja</option>
                                    </select>

                                    @error('ciudad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
