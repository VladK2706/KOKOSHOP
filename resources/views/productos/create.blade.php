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
                                name="precio" value="{{ old('precio') }}" required autocomplete="precio">

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
                                name="tipo_producto" required autocomplete="tipo_producto">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="Superior">Prenda Superior (Camisetas, Blusas, Camisas, Chaquetas, Abrigos)
                                </option>
                                <option value="Inferior">Prenda Inferior (Pantalones, Faldas, Shorts)</option>
                                <option value="Cuerpo_completo">Prenda Cuerpo Completo (Enterizos, Vestidos, Overoles)
                                </option>
                                <option value="Calzado">Calzado (Zapatos, Zapatillas, Botas, Sandalias)</option>
                            </select>

                            @error('tipo_producto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div id="tallas-container">
                        <div class="row mb-3 talla-row">
                            <label for="tallas[0][talla]" class="col-md-4 col-form-label text-md-end">
                                {{ __('Talla') }}</label>
                            <div class="col-md-5">
                                <input id="tallas[0][talla]" type="text"
                                    class="form-control @error('tallas.0.talla') is-invalid @enderror"
                                    name="tallas[0][talla]" value="{{ old('tallas.0.talla') }}" required
                                    autocomplete="talla">

                                @error('tallas.0.talla')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="tallas[0][cantidad]" class="col-md-2 col-form-label text-md-end">
                                {{ __('Cantidad') }}</label>
                            <div class="col-md-3">
                                <input id="tallas[0][cantidad]" type="number"
                                    class="form-control @error('tallas.0.cantidad') is-invalid @enderror"
                                    name="tallas[0][cantidad]" value="{{ old('tallas.0.cantidad') }}" required
                                    autocomplete="cantidad">

                                @error('tallas.0.cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="button" id="add-talla" class="btn btn-secondary">Agregar Talla</button>
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

    <script>
        let tallaIndex = 1;

        document.getElementById('add-talla').addEventListener('click', () => {
            const container = document.getElementById('tallas-container');
            const newRow = document.createElement('div');
            newRow.className = 'row mb-3 talla-row';
            newRow.innerHTML = `
            <label for="tallas[${tallaIndex}][talla]" class="col-md-4 col-form-label text-md-end">Talla</label>
            <div class="col-md-5">
                <input id="tallas[${tallaIndex}][talla]" type="text" class="form-control" name="tallas[${tallaIndex}][talla]" required>
            </div>
            <label for="tallas[${tallaIndex}][cantidad]" class="col-md-2 col-form-label text-md-end">Cantidad</label>
            <div class="col-md-3">
                <input id="tallas[${tallaIndex}][cantidad]" type="number" class="form-control" name="tallas[${tallaIndex}][cantidad]" required>
            </div>
        `;
            container.appendChild(newRow);
            tallaIndex++;
        });
    </script>
@endsection
