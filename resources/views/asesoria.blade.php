@extends('layouts.app')

@section('content')
<style>
        body {
            background-color: #F0E3E6;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .section-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 2.5rem;
            text-align: center;
            color: #6C3E91;
            text-transform: uppercase;
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 100px;
            height: 4px;
            background-color: #C59FC0;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px;
        }

        .card {
            border: none;
            margin-bottom: 2.5rem;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #6C3E91, #C59FC0);
            clip-path: circle(20% at 20% 20%);
            z-index: 0;
            transition: clip-path 0.5s ease;
        }

        .card:hover::before {
            clip-path: circle(80% at 50% 50%);
        }

        .card-icon {
            font-size: 3rem;
            color: #fff;
            position: absolute;
            top: -20px;
            left: 20px;
            background-color: #6C3E91;
            border-radius: 50%;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            z-index: 2;
            transform: translateY(50%); /* Ajuste para centrar verticalmente el ícono */
        }

        .card-title {
            color: #6C3E91;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            font-size: 1.75rem;
            position: relative;
            z-index: 2;
            padding-left: 75px; /* Espacio para el ícono */
        }

        .card-text {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.8;
            position: relative;
            z-index: 2;
            padding-left: 75px; /* Espacio para el ícono */
        }

        .btn-custom {
            background-color: #6C3E91;
            color: #fff;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s;
            position: relative;
            z-index: 2;
        }

        .btn-custom:hover {
            background-color: #4E2436;
            color: #fff;
        }

        .card-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            border-radius: 15px 15px 0 0;
        }

        /* Specific images for each card */
        .card-image.personalizada {
            background-image: url('https://images.unsplash.com/photo-1520975914304-bd6b07044359');
        }

        .card-image.estilo {
            background-image: url('https://images.unsplash.com/photo-1517502166878-35c93a0072bb');
        }

        .card-image.tendencias {
            background-image: url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f');
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 2rem;
            }

            .section-title {
                font-size: 2.5rem;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .card-text {
                font-size: 1rem;
            }

            .btn-custom {
                padding: 0.5rem 1.5rem;
            }

            .card-title,
            .card-text {
                padding-left: 60px; /* Ajuste para dispositivos móviles */
            }

            .card-icon {
                transform: translateY(40%); /* Ajuste para centrar verticalmente el ícono en pantallas más pequeñas */
            }
        }
    </style>

<div class="container my-5">
        <h2 class="section-title">Asesorías</h2>
        <div class="row">
            <!-- Asesoría Personalizada -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-image personalizada"></div>
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h5 class="card-title">Asesoría Personalizada</h5>
                        <p class="card-text">Obtén asesoramiento personalizado para encontrar las prendas que mejor se adapten a tu estilo y personalidad. Nuestros expertos te guiarán en la elección de outfits para cualquier ocasión.</p>
                        <a href="#" class="btn btn-custom">Solicitar Asesoría</a>
                    </div>
                </div>
            </div>
            <!-- Asesoría de Estilo -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-image estilo"></div>
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h5 class="card-title">Asesoría de Estilo</h5>
                        <p class="card-text">Descubre tu estilo único con la ayuda de nuestros estilistas profesionales. Te ayudaremos a definir un guardarropa que refleje tu esencia y te haga sentir confiada y auténtica.</p>
                        <a href="#" class="btn btn-custom">Descubrir más</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Asesoría de Tendencias -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-image tendencias"></div>
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="card-title">Asesoría de Tendencias</h5>
                        <p class="card-text">Mantente al día con las últimas tendencias de la moda. Nuestro equipo de asesores te proporcionará información actualizada sobre lo que está en tendencia y cómo incorporarlo en tu estilo diario.</p>
                        <a href="#" class="btn btn-custom">Explorar Tendencias</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection