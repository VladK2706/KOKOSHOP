@extends('layouts.app')

@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Editar Producto</h2>
            <a href="{{ route('productos.index') }}" class="btn btn-danger">Cancelar</a>
            <div class="card_body">
                <form method="POST" action="{{ route('productos.update', $producto->Id_producto) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end"> {{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre', $producto->nombre) }}" required autocomplete="nombre"
                                autofocus>

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
                                name="precio" value="{{ old('precio', $producto->precio) }}" required
                                autocomplete="precio">

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
                                <option value="" disabled>Seleccionar</option>
                                <option value="Superior" {{ $producto->tipo_producto == 'Superior' ? 'selected' : '' }}>
                                    Prenda Superior (Camisetas, Blusas, Camisas, Chaquetas, Abrigos)</option>
                                <option value="Inferior" {{ $producto->tipo_producto == 'Inferior' ? 'selected' : '' }}>
                                    Prenda Inferior (Pantalones, Faldas, Shorts)</option>
                                <option value="Cuerpo_completo"
                                    {{ $producto->tipo_producto == 'Cuerpo_completo' ? 'selected' : '' }}>Prenda Cuerpo
                                    Completo (Enterizos, Vestidos, Overoles)</option>
                                <option value="Calzado" {{ $producto->tipo_producto == 'Calzado' ? 'selected' : '' }}>
                                    Calzado (Zapatos, Zapatillas, Botas, Sandalias)</option>
                            </select>

                            @error('tipo_producto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div id="tallas-container">
                        @foreach ($producto->tallas as $index => $talla)
                            <div class="row mb-3 talla-row">
                                <label for="tallas[{{ $index }}][talla]"
                                    class="col-md-4 col-form-label text-md-end"> {{ __('Talla') }}</label>
                                <div class="col-md-5">
                                    <input id="tallas[{{ $index }}][talla]" type="text"
                                        class="form-control @error('tallas.' . $index . '.talla') is-invalid @enderror"
                                        name="tallas[{{ $index }}][talla]"
                                        value="{{ old('tallas.' . $index . '.talla', $talla->talla) }}" required
                                        autocomplete="talla">
                                    @error('tallas.' . $index . '.talla')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="tallas[{{ $index }}][cantidad]"
                                    class="col-md-2 col-form-label text-md-end"> {{ __('Cantidad') }}</label>
                                <div class="col-md-3">
                                    <input id="tallas[{{ $index }}][cantidad]" type="number"
                                        class="form-control @error('tallas.' . $index . '.cantidad') is-invalid @enderror"
                                        name="tallas[{{ $index }}][cantidad]"
                                        value="{{ old('tallas.' . $index . '.cantidad', $talla->cantidad) }}" required
                                        autocomplete="cantidad">
                                    @error('tallas.' . $index . '.cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="button" id="add-talla" class="btn btn-secondary">Agregar Talla</button>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar Producto') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let tallaIndex = {{ count($producto->tallas) }};

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
