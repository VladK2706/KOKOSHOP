@extends('layouts.app')
@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Productos</h2>
            <div class="title-crud">
                <a href="{{ route('productos.create') }}" class="btn btn-primary">Agregar Producto</a>
            </div>

            @if (sizeof($productos) > 0)
                <table class="table">
                    <thead>
                        <th>Id Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad Total</th>
                        <th>Tipo de Prodcuto</th>
                        <th>Talla 1</th>
                        <th>Talla 2</th>
                        <th>Talla 3</th>
                        <th>Talla 4</th>
                        <th>Talla 5</th>
                        <th class="text-center">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->Id_producto }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>$ {{ $producto->precio }}</td>
                                <td>{{ $producto->cantidad_total }}</td>
                                <td>{{ $producto->tipo_producto }}</td>

                                @if ($producto->tipo_producto == 'Superior' || $producto->tipo_producto == 'Cuerpo_completo')
                                    <td>XS: {{ $producto->cantidadTalla->talla1 }}</td>
                                    <td>S: {{ $producto->cantidadTalla->talla2 }}</td>
                                    <td>M: {{ $producto->cantidadTalla->talla3 }}</td>
                                    <td>L: {{ $producto->cantidadTalla->talla4 }}</td>
                                    <td>XL: {{ $producto->cantidadTalla->talla5 }}</td>
                                @elseif ($producto->tipo_producto == 'Inferior')
                                    <td>26: {{ $producto->cantidadTalla->talla1 }}</td>
                                    <td>28: {{ $producto->cantidadTalla->talla2 }}</td>
                                    <td>30: {{ $producto->cantidadTalla->talla3 }}</td>
                                    <td>32: {{ $producto->cantidadTalla->talla4 }}</td>
                                    <td>34: {{ $producto->cantidadTalla->talla5 }}</td>
                                @elseif ($producto->tipo_producto == 'Calzado')
                                    <td>35: {{ $producto->cantidadTalla->talla1 }}</td>
                                    <td>36: {{ $producto->cantidadTalla->talla2 }}</td>
                                    <td>37: {{ $producto->cantidadTalla->talla3 }}</td>
                                    <td>38: {{ $producto->cantidadTalla->talla4 }}</td>
                                    <td>39: {{ $producto->cantidadTalla->talla5 }}</td>
                                @else
                                    <td>{{ $producto->cantidadTalla->talla1 }}</td>
                                    <td>{{ $producto->cantidadTalla->talla2 }}</td>
                                    <td>{{ $producto->cantidadTalla->talla3 }}</td>
                                    <td>{{ $producto->cantidadTalla->talla4 }}</td>
                                    <td>{{ $producto->cantidadTalla->talla5 }}</td>
                                @endif
                                <td class="text-center">
                                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-success">Editar</a>
                                    <form method="POST" action="{{ route('productos.destroy', $producto) }}"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"
                                            onclick="return confirm('¿Esta seguro de elminar este Producto?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
