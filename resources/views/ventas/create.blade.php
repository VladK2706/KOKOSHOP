@extends('layouts.app')

@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Registrar Venta</h2>
            <a href="{{ route('ventas.index') }}" class="btn btn-danger">Cancelar</a>
            <div class="card_body">
                <form method="POST" action="{{ route('ventas.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="Id_cli" class="col-md-4 col-form-label text-md-end">{{ __('Cliente') }}</label>
                        <div class="col-md-6">
                            <select id="Id_cli" class="form-control @error('Id_cli') is-invalid @enderror" name="Id_cli"
                                required>
                                <option value="" disabled selected>Seleccionar Cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                @endforeach
                            </select>
                            @error('Id_cli')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Id_Emp" class="col-md-4 col-form-label text-md-end">{{ __('Empleado') }}</label>
                        <div class="col-md-6">
                            <select id="Id_Emp" class="form-control @error('Id_Emp') is-invalid @enderror" name="Id_Emp"
                                required>
                                <option value="" disabled selected>Seleccionar Empleado</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                @endforeach
                            </select>
                            @error('Id_Emp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fecha_venta"
                            class="col-md-4 col-form-label text-md-end">{{ __('Fecha de Venta') }}</label>
                        <div class="col-md-6">
                            <input id="fecha_venta" type="date"
                                class="form-control @error('fecha_venta') is-invalid @enderror" name="fecha_venta"
                                value="{{ old('fecha_venta') }}"required>
                            @error('fecha_venta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tipo_venta"
                            class="col-md-4 col-form-label text-md-end">{{ __('Tipo de Venta') }}</label>
                        <div class="col-md-6">
                            <input id="tipo_venta" type="text"
                                class="form-control @error('tipo_venta') is-invalid @enderror" name="tipo_venta"
                                value="{{ old('tipo_venta') }}" required>
                            @error('tipo_venta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('Estado') }}</label>
                        <div class="col-md-6">
                            <input id="estado" type="text" class="form-control @error('estado') is-invalid @enderror"
                                name="estado" value="{{ old('estado') }}" required>
                            @error('estado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <h4>Productos</h4>
                    <div id="productos">
                        <div class="row mb-3 producto-row">
                            <label for="productos[0][Id_producto]"
                                class="col-md-4 col-form-label text-md-end">{{ __('Producto') }}</label>
                            <div class="col-md-6">
                                <select id="productos[0][Id_producto]"
                                    class="form-control @error('productos.0.Id_producto') is-invalid @enderror"
                                    name="productos[0][Id_producto]" required>
                                    <option value="" disabled selected>Seleccionar Producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->Id_producto }}">{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('productos.0.Id_producto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3 producto-row">
                            <label for="productos[0][talla_producto]"
                                class="col-md-4 col-form-label text-md-end">{{ __('Talla') }}</label>
                            <div class="col-md-6">
                                <input id="productos[0][talla_producto]" type="text"
                                    class="form-control @error('productos.0.talla_producto') is-invalid @enderror"
                                    name="productos[0][talla_producto]" value="{{ old('productos.0.talla_producto') }}">
                                @error('productos.0.talla_producto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 producto-row">
                            <label for="productos[0][talla_producto]"
                                class="col-md-4 col-form-label text-md-end">{{ __('Talla') }}</label>
                            <select name="productos[0][talla_producto]" id="productos[0][talla_producto]"
                                class="form-control @error('productos.0.Id_producto') is-invalid @enderror">
                                @foreach ($productos as $producto)
                                @if ($producto->tipo_producto == 'Superior' || $producto->tipo_producto == 'Cuerpo_completo')
                                    
                                @endif
                                    <option value="{{ $producto->cantidadTalla }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        

                        <div class="row mb-3 producto-row">
                            <label for="productos[0][cantidad_producto]"
                                class="col-md-4 col-form-label text-md-end">{{ __('Cantidad') }}</label>
                            <div class="col-md-6">
                                <input id="productos[0][cantidad_producto]" type="number"
                                    class="form-control @error('productos.0.cantidad_producto') is-invalid @enderror"
                                    name="productos[0][cantidad_producto]"
                                    value="{{ old('productos.0.cantidad_producto') }}" required>
                                @error('productos.0.cantidad_producto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn btn-secondary" id="add-producto">
                                {{ __('Agregar Producto') }}
                            </button>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrar Venta') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="{{ asset('js/ventas.js') }}"></script>
@endsection
