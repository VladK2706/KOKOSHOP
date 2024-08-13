@extends('layouts.app')

@section('content')

<div class="imagen-principal">
    <img class="" src="{{ asset('images/imagen_principal.png') }}" alt="">
    <div class="capa-oscura"></div>
    <div class="text-img-principal">
        ENCUENTRA LO QUE NECESITES
    </div>
</div>


<div class="nav-bar tipos-productos">
    <nav class="main-menu tipo-ropa" style="display: block;">
        <ul>

            <a href="#principal">Blusas</a>

            <a href="#productos">Chaquetas</a>

            <a href="#nosotros">Pantalones</a>

            <a href="#asesoria">Zapatos</a>

        </ul>
    </nav>
</div>

<div class="container catalogo">
    <h1 class="novedades">NOVEDADES</h1>
    <div class="row align-items-center productos">
        <div class="col-3 producto">
            <div class="uni-producto">
                <a href="producto.html">
                    <img src="images/faldacuero.jpg" alt="" class="img-producto">
                    <div class="capa-oscura-producto"></div>
                </a>
            </div>
            <div class="text-product">
                <a class="nom-producto" href="producto.html">Falda de Cuero</a>
                <span class="precio">$ 50000</span>
            </div>
        </div>
        <div class="col-3 producto">
            <div class="uni-producto">
                <a href="producto.html">
                    <img src="images/camisacargo.jpg" alt="" class="img-producto">
                    <div class="capa-oscura-producto"></div>
                </a>
            </div>
            <div class="text-product">
                <a class="nom-producto" href="producto.html">Chaqueta de Cuero</a>
                <span class="precio">$ 63000</span>
            </div>
        </div>
        <div class="col-3 producto">
            <div class="uni-producto">
                <a href="producto.html">
                    <img src="images/pantalon mezclilla.webp" alt="" class="img-producto">
                    <div class="capa-oscura-producto"></div>
                </a>
            </div>
            <div class="text-product">
                <a class="nom-producto" href="producto.html">Pantalon de mezclilla</a>
                <span class="precio">$ 55000</span>
            </div>
        </div>
        <div class="col-3 producto">
            <div class="uni-producto">
                <a href="producto.html">
                    <img src="images/af1.webp" alt="" class="img-producto">
                    <div class="capa-oscura-producto"></div>
                </a>
            </div>
            <div class="text-product">
                <a class="nom-producto" href="producto.html">Air Force One</a>
                <span class="precio">$ 100000</span>
            </div>
        </div>
    </div>
</div>
@endsection
