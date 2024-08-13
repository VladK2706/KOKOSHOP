@extends('layouts.app')

@section('content')
<style>
    

.col-3 {
    flex: 0 0 25%;
    max-width: 25%;
}

h5 {
    font-family: "lilita one", serif;
    font-size: 20px;
    color: rgb(0, 0, 0);
    font-weight: 500;

}

ul {
    list-style: none !important;
    /* Elimina los puntos de la lista */
}








ul {
    display: block;
    list-style-type: disc;
    margin-block-start: 0;
    margin-block-end: 0;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 0;
    float: none;
    width: auto;
}


.text-img-principal {
    position: absolute;
    width: 500px;
    top: 40%;
    left: 10%;
    z-index: 1;
    font-family: "lilita one", serif;
    padding: 10px;
    color: #f5ccd4;
    font-size: 100px;
    font-weight: 400;
    font-style: normal;
}

.imagen-principal {
    padding-top: 100px;
    width: 100%;
    height: 980px;

    overflow: hidden;
}

#img_principal {
    width: 100%;
    height: auto;
    clip-path: inset(0);


}

.capa-oscura {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 980px;
    background-color: black;
    opacity: 0.5;
}











/* ----------------productos---------------- */











.tipos-productos {
    background-color: #b8a4c9;
}

.tipo-ropa ul a {
    color: #000000;
}

.tipo-ropa ul a:hover {
    background-color: #000000;
    color: #f5ccd4;
}



.catalogo {
    padding: 40px 0 40px;
    background-color: #000000;
}

.novedades {
    font-family: "lilita one", serif;
    font-size: 40px;
    font-weight: 400;
    font-style: normal;
    color: #f5ccd4;
}

.productos {
    height: auto;
    padding: 20px 0 0;
    display: flex;
    margin: 0 auto;

}

.producto {
    max-width: 25%;
    border: none;
    box-sizing: border-box;
    width: 100%;
    height: auto;
    position: relative;
    padding: 0 10px 30px;
    max-height: 600px;
}

.img-producto {
    width: 100%;
    height: auto;
    border-radius: 5px;
    position: relative;
    aspect-ratio: 1/1;
    Object-fit: cover;
    max-width: 100%;
    max-height: 100%;
}

.uni-producto {
    overflow: hidden;
    max-height: 400px;
}

.capa-oscura-producto {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 340px;
    background-color: black;
    opacity: 0;

}

.uni-producto:hover .capa-oscura-producto {
    opacity: 0.3;
}



.text-product {
    padding: 10px 0;
    width: 100%;
    float: left;
    text-align: left;
    color: #f5ccd4;
    font-weight: 600;
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.text-product a {
    flex-grow: 1;
    color: #f5ccd4;
    text-decoration: none;
}

.text-product a:hover {
    color: #b8a4c9;
}

.precio {
    margin-left: 10px;
}


/*--------------------------- pie de pagina ---------------------------*/


</style>
<div class="imagen-principal">
    <img class="" src="{{ asset('images/imagen_principal.png') }}" alt="">
    <div class="capa-oscura"></div>
    <div class="text-img-principal">
        ENCUENTRA LO QUE NECESITES
    </div>
</div>

<!--
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
-->

<div class="container catalogo">
    <h1 class="novedades">NOVEDADES</h1>
    <div class="row align-items-center productos">
        <div class="col-3 producto">
            <div class="uni-producto">
                <a href="producto.html">
                    <img src="images/faldacuero.jpg" alt="" class="img-producto">
                    
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
