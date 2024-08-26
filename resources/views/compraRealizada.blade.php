@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .invoice-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .header {
            border-bottom: 2px solid #9e54e4;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 1.75rem;
            color: #9e54e4;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 0;
        }

        .products-list {
            margin-top: 20px;
        }

        .products-list li {
            font-size: 1rem;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .products-list li:last-child {
            border-bottom: none;
        }

        .total {
            text-align: right;
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }
    </style>
    </head>

    <body>

        <div class="container">
            <div class="invoice-container">
                <div class="header text-center">
                    <h1>Factura</h1>
                </div>

                <div class="invoice-details">
                    <div>
                        <p><strong>N° de referencia:</strong> {{ $venta->Id_venta }}</p>
                        <p><strong>Fecha:</strong> {{ $venta->fecha_venta }}</p>
                    </div>

                </div>

                <div class="products-list">
                    @foreach ($productosDetallados as $producto)
                        <h6><strong>Productos adquiridos</strong></h6>
                        <ul class="list-unstyled">
                            <li>{{ $producto['nombre'] }}, Talla {{ $producto['talla'] }}, Cantidad:
                                {{ $producto['cantidad'] }}</li>
                        </ul>
                    @endforeach
                    <p><strong>Unico metodo de pago: </p>
                    </trong>
                    <div>
                        <p>Nequi.<br>
                            (Tu pedido no se procesará hasta que se haya recibido el importe en nuestra cuenta)
                        </p>
                    </div>

                    <div class="total">
                        <p>Precio de envío: $17000</p>
                        <p>Total a pagar: ${{ $venta->precio_Total }}</p>
                    </div>
                </div>
            </div>
        @endsection
