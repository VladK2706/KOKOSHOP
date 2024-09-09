@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #000000;
        }
    </style>
    <div class="w-100">
        <div class="imagen-principal">
        <style>
            * {
                box-sizing: border-box;
            }
    
            body {
                margin: 0;
                font-family: Arial;
                font-size: 17px;
            }
    
            .imagen-principal {
                position: relative;
                width: 100%;
                height: 500px; /* Ajusta la altura que desees para tu sección */
                overflow: hidden; /* Asegura que el video no se salga del contenedor */
            }
    
            #myVideo {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover; /* Asegura que el video se ajuste al contenedor sin distorsión */
            }
    
            .content {
                position: absolute;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                color: #f1f1f1;
                width: 100%;
                padding: 20px;
            }
    
            #myBtn {
                width: 200px;
                font-size: 18px;
                padding: 10px;
                border: none;
                background: #000;
                color: #fff;
                cursor: pointer;
            }
    
            #myBtn:hover {
                background: #ddd;
                color: black;
            }
        </style>
    
        <video autoplay muted loop id="myVideo">
            <source src="video/video_background.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
    
        <div class="content">
            <h1>Encuentra lo que necesitas</h1>
            <p>Conoce nuestra colección.</p>
            <button id="myBtn" onclick="redirectFunction()">Comprar Ahora</button>
        </div>
        
        <script>
            function redirectFunction() {
                window.location.href = "productos.html";  // Ruta relativa a la página HTML
            }
        </script>
    </div>


        <div class="container">
            <div class="catalogo">
                <h1 class="novedades">NOVEDADES</h1>
                <div class="row align-items-start productos">
                    @foreach ($productos->take(4) as $producto)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 producto">
                            <div class="uni-producto" style="height: 300px;">
                                <a href="{{ route('producto.ver', $producto->Id_producto) }}">
                                    <img  src="{{ asset('images/productos/' . $producto->nombre_imagen . '.jpg') }}"
                                        alt="{{ $producto->nombre_imagen }}" class="img-fluid h-100 w-100"
                                        style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="text-product row align-items-start">
                                <a class="nom-producto col-7 text-decoration-none"
                                    href="producto.html">{{ $producto->nombre }}</a>
                                <span class="col-5 text-end ">$ {{ $producto->precio }}</span>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
