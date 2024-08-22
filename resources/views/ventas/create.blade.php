@extends('layouts.app')

@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Registrar Venta</h2>
            <a href="{{ route('ventas.index') }}" class="btn btn-danger">Cancelar</a>
            <div class="card_body">
                <form action="{{ route('ventas.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="Id_cli" class="col-md-4 col-form-label text-md-end">Cliente</label>
                        <div class="col-md-6">
                            <select class="form-control @error('Id_cli') is-invalid @enderror" id="Id_cli" name="Id_cli"
                                required>
                                <option value="">Selecciona un cliente</option>
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
                        <label for="Id_Emp" class="col-md-4 col-form-label text-md-end">Empleado</label>
                        <div class="col-md-6">
                            <select class="form-control @error('Id_Emp') is-invalid @enderror" id="Id_Emp" name="Id_Emp"
                                required>
                                <option value="">Selecciona un empleado</option>
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
                        <label for="fecha_venta" class="col-md-4 col-form-label text-md-end">Fecha de Venta</label>
                        <div class="col-md-6">
                            <input id="fecha_venta" type="date"
                                class="form-control @error('fecha_venta') is-invalid @enderror" name="fecha_venta"
                                value="{{ old('fecha_venta') }}" required>
                            @error('fecha_venta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tipo_venta" class="col-md-4 col-form-label text-md-end">Tipo de Venta</label>
                        <div class="col-md-6">
                            <select id="tipo_venta" class="form-control @error('tipo_venta') is-invalid @enderror"
                                name="tipo_venta" required>
                                <option value="" disabled selected>Seleccionar Tipo de Venta</option>
                                <option value="Virtual">Virtual</option>
                                <option value="Fisica">Fisica</option>
                            </select>
                            @error('tipo_venta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="estado" class="col-md-4 col-form-label text-md-end">Estado</label>
                        <div class="col-md-6">
                            <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado"
                                required>
                                <option value="" disabled selected>Seleccionar Estado de Venta</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Pagada">Pagada</option>
                                <option value="Enviada">Enviada</option>
                                <option value="Entregada">Entregada</option>
                            </select>
                            @error('estado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Id_producto" class="col-md-4 col-form-label text-md-end">Producto</label>
                        <div class="col-md-6">
                            <select class="form-control @error('Id_producto') is-invalid @enderror" id="Id_producto"
                                name="productos[0][Id_producto]" required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->Id_producto }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            @error('Id_producto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="talla_producto" class="col-md-4 col-form-label text-md-end">Talla</label>
                        <div class="col-md-6">
                            <select class="form-control @error('talla_producto') is-invalid @enderror" id="talla_producto"
                                name="productos[0][talla_producto]" required>
                                <option value="">Selecciona una talla</option>
                            </select>
                            @error('talla_producto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cantidad_producto" class="col-md-4 col-form-label text-md-end">Cantidad</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('cantidad_producto') is-invalid @enderror"
                                id="cantidad_producto" name="productos[0][cantidad_producto]" required>
                            @error('cantidad_producto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Registrar Venta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tallasPorProducto = @json($tallasPorProducto);

            document.getElementById('Id_producto').addEventListener('change', function() {
                const productoId = this.value;
                const tallaSelect = document.getElementById('talla_producto');
                tallaSelect.innerHTML = '<option value="">Selecciona una talla</option>';

                if (tallasPorProducto.hasOwnProperty(parseInt(productoId))) {
                    const tallas = tallasPorProducto[parseInt(productoId)];
                    tallas.forEach((talla, index) => {
                        const option = document.createElement('option');
                        option.value = talla;
                        option.text = talla;
                        option.id = 'talla_option_' + (index + 1);
                        tallaSelect.add(option);
                    });
                }
            });
        });
    </script>
@endsection
