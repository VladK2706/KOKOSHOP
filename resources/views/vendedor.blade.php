@extends('layouts.app')
@section('content')
    <style>
        body {
            background-color: #F6F0FF;
            color: #333333;
            font-family: Arial, sans-serif;
        }

        .panels-container {
            display: flex;
            flex-grow: 1;
            gap: 20px;
            height: 500px;
        }

        .left-panel,
        .right-panel {
            padding: 20px;
            background-color: #D1C4E9;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .right-panel {
            flex: 3;
            overflow-y: auto;
        }

        .panel {}

        h4 {
            color: #3E2C57;
        }

        .form-control {
            background-color: #EDE7F6;
            border: 1px solid #3E2C57;
            color: #333333;
        }

        .add-button {
            background-color: #3E2C57;
            color: #ffffff;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            margin-top: 10px;
            font-weight: bold;
        }

        .finalize-button {
            background-color: #311B3F;
            color: #ffffff;
            border: none;
            width: 200px;
            padding: 12px;
            border-radius: 5px;
            font-weight: bold;
            align-self: flex-end;
        }

        .venta {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #EDE7F6;
            border-radius: 10px;
            background-color: #FBF9FF;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.05);
        }

        .venta img {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 10px;
            border: 2px solid #3E2C57;
        }

        .venta p {
            margin: 0;
            font-weight: bold;
        }
    </style>
    </head>

    <body>
        <div class="container py-4 ">
            <div class="panels-container h-75">
                <div class="left-panel panel">
                    <h4>Cliente</h4>
                    <input type="text" class="form-control mb-3" placeholder="Número de Documento...">
                    <hr>
                    <input type="text" class="form-control mb-3" placeholder="ID Producto...">
                    <button class="add-button">Agregar Prodcuto</button>
                </div>
                <div class="right-panel panel">
                    <div class="venta">
                        <img src="https://via.placeholder.com/60" alt="Producto">
                        <div>
                            <p>Producto: Pantalón</p>
                            <p>Talla: M</p>
                            <p>Cantidad: 2</p>
                        </div>
                    </div>
                    <div class="venta">
                        <img src="https://via.placeholder.com/60" alt="Producto">
                        <div>
                            <p>Producto: Camiseta</p>
                            <p>Talla: L</p>
                            <p>Cantidad: 1</p>
                        </div>
                    </div>
                    <!-- Añadir más productos aquí -->
                </div>
            </div>
            <div class="text-end py-3">
                <button class="finalize-button ">Realizar Venta</button>
            </div>

        </div>
    @endsection
