@extends('layouts.app')

@section('content')
    <h1>Formulario de Compra</h1>

    <div>
        <h2>{{ $producto->nombre }}</h2>
        <p>Precio: ${{ number_format($producto->precio, 2) }} COP</p>
    </div>

    <form action="{{ route('compra.procesar') }}" method="POST">
        @csrf

        <input type="hidden" name="Id_cli" value="{{ auth()->user()->id }}">
        <input type="hidden" name="Id_producto" value="{{ $producto->Id_producto }}">
        <input type="hidden" name="Id_Emp" value="1"> <!-- Cambia esto según sea necesario -->

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="productos[0][cantidad_producto]" id="cantidad" min="1" value="1">

        <label for="talla">Talla:</label>
        <select name="productos[0][talla_producto]" id="talla">
            @foreach($tallas as $talla)
                <option value="{{ $talla }}">{{ $talla }}</option>
            @endforeach
        </select>

        <input type="hidden" name="productos[0][Id_producto]" value="{{ $producto->Id_producto }}">

        <label for="fecha_venta">Fecha de Venta:</label>
        <input type="date" name="fecha_venta" id="fecha_venta" value="{{ now()->format('Y-m-d') }}">

        <label for="tipo_venta">Tipo de Venta:</label>
        <input type="text" name="tipo_venta" id="tipo_venta" value="Online">

        <input type="hidden" name="estado" value="Pendiente">

        <button type="submit">Confirmar Compra</button>
    </form>
@endsection
