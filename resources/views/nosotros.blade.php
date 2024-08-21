@extends('layouts.app')

@section('content')

<style>
        body {
            background-color: #F8F0F6;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .section-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 3rem;
            text-align: center;
            color: #6C3E91;
            text-transform: uppercase;
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 100px;
            height: 5px;
            background-color: #C59FC0;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -15px;
            border-radius: 5px;
        }

        .card {
            border: none;
            margin-bottom: 2.5rem;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 3rem;
            position: relative;
            z-index: 1;
            background: linear-gradient(45deg, #F8F0F6, #ffffff);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #6C3E91, #C59FC0);
            clip-path: circle(15% at 10% 10%);
            z-index: 0;
            transition: clip-path 0.5s ease;
        }

        .card:hover::before {
            clip-path: circle(75% at 50% 50%);
        }

        .card-title {
            color: #6C3E91;
            font-weight: bold;
            margin-bottom: 2rem;
            text-transform: uppercase;
            font-size: 2rem;
            position: relative;
            z-index: 2;
        }

        .card-text {
            color: #333;
            font-size: 1.2rem;
            line-height: 2;
            position: relative;
            z-index: 2;
        }

        .location-map {
            border: none;
            height: 350px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(108, 62, 145, 0.3);
            transition: transform 0.3s;
        }

        .location-map:hover {
            transform: scale(1.05);
        }

        .location {
            background-color: #FFF5FB;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(108, 62, 145, 0.2);
            position: relative;
            overflow: hidden;
        }

        .location::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #6C3E91, #C59FC0);
            clip-path: circle(25% at 90% 10%);
            z-index: 0;
            transition: clip-path 0.5s ease;
        }

        .location:hover::before {
            clip-path: circle(75% at 50% 50%);
        }

        .location h5 {
            color: #6C3E91;
            position: relative;
            z-index: 2;
        }

        .location p {
            color: #4E2436;
            font-size: 1.2rem;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 2rem;
            }

            .section-title {
                font-size: 2.5rem;
            }

            .card-title {
                font-size: 1.75rem;
            }

            .card-text {
                font-size: 1.1rem;
            }

            .location {
                padding: 2rem;
            }

            .location p {
                font-size: 1.1rem;
            }
        }
    </style>

<div class="container my-5">
        <h2 class="section-title">Nosotros</h2>
        <div class="row">
            <!-- Misión -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Misión</h5>
                        <p class="card-text">En Kokoshop, nuestra misión es ofrecer una experiencia de compra en línea personalizada y amigable,
                             proporcionando una selección cuidadosamente curada de ropa femenina de alta calidad. Nos comprometemos a inspirar a nuestras clientas con las últimas tendencias y a promover la diversidad y la inclusión,
                              creando un espacio donde cada mujer pueda encontrar su estilo único.</p>
                    </div>
                </div>
            </div>
            <!-- Visión -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Visión</h5>
                        <p class="card-text">Kokosho aspira a convertirse en la tienda de ropa femenina líder en el mercado, 
                            destacándose por ofrecer piezas únicas que combinan estilo, comodidad y accesibilidad. Nuestro objetivo es empoderar a las mujeres de todas las edades y tallas,
                             proporcionándoles ropa que no solo las haga lucir bien, sino que también las haga sentir seguras y auténticas. Nos visualizamos como un referente global en moda.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Nosotros -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nosotros</h5>
                        <p class="card-text">¡Descubre la nueva era de la moda femenina en nuestra tienda online! Desde prendas personalizadas hasta experiencias de compra en 3D y recomendaciones de estilo, estamos redefiniendo la forma en que te relacionas con la moda.

                            Únete a nosotros para explorar colecciones exclusivas, colaboraciones con diseñadores emergentes y beneficios VIP que te harán sentir especial en cada compra. Sumérgete en la innovación y descubre tu estilo único con nosotros.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Ubicación -->
            <div class="col-md-12">
                <div class="card location">
                    <div class="card-body">
                        <h5 class="card-title">Ubicación</h5>
                        <p class="card-text">Encuéntranos en nuestra tienda principal o visita nuestra tienda en línea para descubrir nuestras últimas colecciones:</p>
                        <p class="card-text"><strong>Dirección:</strong> Quiroga calle 40, Bogotá, Colombia.</p>
                        <!-- Mapa integrado -->
                        <iframe
                            class="location-map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8335764518687!2d144.96315791541824!3d-37.814107979751716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43db0fd7b3%3A0x5045675218ce6e0!2sVictoria%20State%20Library%2C%20Melbourne%2C%20Australia!5e0!3m2!1sen!2sus!4v1601032492758!5m2!1sen!2sus"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection