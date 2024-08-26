@extends('layouts.app')
@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Ventas</h2>
            <div class="title-crud">
                @if (Auth::user()->id_rol == 3)
                    <a href="{{ route('ventaFormulario') }}" class="btn btn-primary">Realizar asdasdVenta</a>
                @else
                    <a href="{{ route('ventas.create') }}" class="btn btn-primary">Realizar Venta</a>
                @endif

            </div>

            @if (sizeof($ventas) > 0)
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Fecha de venta</th>
                        <th>Tipo de Venta</th>
                        <th>Estado de venta</th>
                        <th>Precio Total</th>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->Id_venta }}</td>
                                <td>{{ $venta->fecha_venta }}</td>
                                <td>{{ $venta->tipo_venta }}</td>
                                <td>{{ $venta->estado }}</td>
                                <td>$ {{ $venta->precio_Total }}.00</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <div class="alert alert-secondary">No se encontraron registros</div>
            @endif

        </div>
    </div>
@endsection
