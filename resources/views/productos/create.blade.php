@extends('layouts.app')
@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Registrar Producto</h2>
            <a href="{{ route('productos.index') }}" class="btn btn-danger">Cancelar</a>
            <div class="card_body">
                <form method="POST" action="{{ route('productos.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end"> {{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="precio" class="col-md-4 col-form-label text-md-end"> {{ __('Precio') }}</label>
                        <div class="col-md-6">
                            <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror"
                                name="precio" value="{{ old('precio') }}" required autocomplete="nombre">

                            @error('precio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tipo_producto"
                            class="col-md-4 col-form-label text-md-end">{{ __('Tipo de Prenda de Ropa') }}</label>

                        <div class="col-md-6">

                            <select id="tipo_producto" class="form-control @error('id_rol') is-invalid @enderror"
                                name="tipo_producto" value="{{ old('tipo_producto') }}" required
                                autocomplete="tipo_producto">
                                <option value="" disabled selected>Selecionar</option>
                                <option value="Superior">Prenda Superior (Camisetas, Blusas, Camisas, Chaquetas, Abrigos)
                                </option>
                                <option value="Inferior">Prenda Inferiro (Pantalones, Faldas, Shorts)</option>
                                <option value="Cuerpo_completo">Prenda Cuerpo Completo (Enterizos, Vestidos, Overoles)
                                </option>
                                <option value="Calzado">Calzado (Zapatos, Zapatilas, Botas, Sandalias)</option>
                            </select>
                            <p class="text-danger" id="error"></p>
                            @error('tipo_producto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="talla1" id="textTalla1" class="col-md-4 col-form-label text-md-end">
                            {{ __('Talla 1') }}</label>
                        <div class="col-md-6">
                            <input id="talla1" type="number" class="form-control @error('talla1') is-invalid @enderror"
                                name="talla1" value="{{ old('talla1') }}" required autocomplete="nombre">

                            @error('talla1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="talla2" id="textTalla2" class="col-md-4 col-form-label text-md-end">
                            {{ __('Talla 2') }}</label>
                        <div class="col-md-6">
                            <input id="talla2" type="number" class="form-control @error('talla2') is-invalid @enderror"
                                name="talla2" value="{{ old('talla2') }}" required autocomplete="nombre">

                            @error('talla2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="talla3" id="textTalla3" class="col-md-4 col-form-label text-md-end">
                            {{ __('Talla 3') }}</label>
                        <div class="col-md-6">
                            <input id="talla3" type="number" class="form-control @error('talla3') is-invalid @enderror"
                                name="talla3" value="{{ old('talla3') }}" required autocomplete="nombre">

                            @error('talla3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="talla4" id="textTalla4" class="col-md-4 col-form-label text-md-end">
                            {{ __('Talla 4') }}</label>
                        <div class="col-md-6">
                            <input id="talla4" type="number" class="form-control @error('talla4') is-invalid @enderror"
                                name="talla4" value="{{ old('talla4') }}" required autocomplete="nombre">

                            @error('talla4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="talla5" id="textTalla5" class="col-md-4 col-form-label text-md-end">
                            {{ __('Talla 5') }}</label>
                        <div class="col-md-6">
                            <input id="talla5" type="number"
                                class="form-control @error('talla5') is-invalid @enderror" name="talla5"
                                value="{{ old('talla5') }}" required autocomplete="nombre">

                            @error('talla5')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrar Producto') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/producto.js') }}"></script>
@endsection
