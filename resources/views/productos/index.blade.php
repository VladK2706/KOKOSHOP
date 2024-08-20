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
                        <th>Nombre de Imagen</th>
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
                                <td>{{ $producto->nombre_imagen }}</td>
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
