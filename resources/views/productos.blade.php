@extends('layouts.app')
@section('content')
    <style>
        body {
            background-color: #000000;
        }
    </style>
    <div class="container">
        <div class="catalogo">
            <h1 class="novedades">PRODUCTOS</h1>
            <div class="row align-items-start productos">
                @foreach ($productos as $producto)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 producto">
                        <div class="uni-producto" style="height: 300px;">
                            <a href="producto.html">
                                <img src="{{ asset('images/productos/' . $producto->nombre_imagen . '.jpg') }}"
                                    alt="{{ $producto->nombre_imagen }}" class="img-fluid h-100 w-100"
                                    style="object-fit: cover;">
                            </a>
                        </div>
                        <div class="text-product row">
                            <a class="nom-producto col-7 text-decoration-none"
                                href="producto.html">{{ $producto->nombre }}</a>
                            <span class="col-5 text-end ">$ {{ $producto->precio }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
