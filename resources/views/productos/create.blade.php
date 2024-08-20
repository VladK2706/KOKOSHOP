@extends('layouts.app')
@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Registrar Producto</h2>
            <a href="{{ route('productos.index') }}" class="btn btn-danger">Cancelar</a>
            <div class="card_body">
                <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
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
                                name="precio" value="{{ old('precio') }}" required>

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
                            <select id="tipo_producto" class="form-control @error('tipo_producto') is-invalid @enderror"
                                name="tipo_producto" value="{{ old('tipo_producto') }}" required>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="Superior">Prenda Superior</option>
                                <option value="Inferior">Prenda Inferior</option>
                                <option value="Cuerpo_completo">Prenda Cuerpo Completo</option>
                                <option value="Calzado">Calzado</option>
                            </select>

                            @error('tipo_producto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="nombre_imagen"
                            class="col-md-4 col-form-label text-md-end">{{ __('Imagen del Producto') }}</label>

                        <div class="col-md-6">
                            <input id="nombre_imagen" type="file"
                                class="form-control @error('nombre_imagen') is-invalid @enderror" name="nombre_imagen"
                                required>

                            @error('nombre_imagen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    @for ($i = 1; $i <= 5; $i++)
                        <div class="row mb-3">
                            <label for="talla{{ $i }}" id="textTalla{{ $i }}"
                                class="col-md-4 col-form-label text-md-end">
                                {{ __('Talla ' . $i) }}</label>
                            <div class="col-md-6">
                                <input id="talla{{ $i }}" type="number"
                                    class="form-control @error('talla{{ $i }}') is-invalid @enderror"
                                    name="tallas[{{ $i }}][cantidad]"
                                    value="{{ old('tallas.' . $i . '.cantidad') }}" required>

                                @error('talla{{ $i }}')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endfor

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
@endsection
