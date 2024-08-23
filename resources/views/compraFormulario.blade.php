@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script type="text/javascript">
        window.tailwind.config = {
            darkMode: ['class'],
            theme: {
                extend: {
                    colors: {
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        primary: {
                            DEFAULT: 'hsl(var(--primary))',
                            foreground: 'hsl(var(--primary-foreground))'
                        },
                        secondary: {
                            DEFAULT: 'hsl(var(--secondary))',
                            foreground: 'hsl(var(--secondary-foreground))'
                        },
                        destructive: {
                            DEFAULT: 'hsl(var(--destructive))',
                            foreground: 'hsl(var(--destructive-foreground))'
                        },
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
                        },
                        popover: {
                            DEFAULT: 'hsl(var(--popover))',
                            foreground: 'hsl(var(--popover-foreground))'
                        },
                        card: {
                            DEFAULT: 'hsl(var(--card))',
                            foreground: 'hsl(var(--card-foreground))'
                        },
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: 0 0% 100%;
                --foreground: 240 10% 3.9%;
                --card: 0 0% 100%;
                --card-foreground: 240 10% 3.9%;
                --popover: 0 0% 100%;
                --popover-foreground: 240 10% 3.9%;
                --primary: 240 5.9% 10%;
                --primary-foreground: 0 0% 98%;
                --secondary: 240 4.8% 95.9%;
                --secondary-foreground: 240 5.9% 10%;
                --muted: 240 4.8% 95.9%;
                --muted-foreground: 240 3.8% 46.1%;
                --accent: 240 4.8% 95.9%;
                --accent-foreground: 240 5.9% 10%;
                --destructive: 0 84.2% 60.2%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 5.9% 90%;
                --input: 240 5.9% 90%;
                --ring: 240 5.9% 10%;
                --radius: 0.5rem;
            }

            .dark {
                --background: 240 10% 3.9%;
                --foreground: 0 0% 98%;
                --card: 240 10% 3.9%;
                --card-foreground: 0 0% 98%;
                --popover: 240 10% 3.9%;
                --popover-foreground: 0 0% 98%;
                --primary: 0 0% 98%;
                --primary-foreground: 240 5.9% 10%;
                --secondary: 240 3.7% 15.9%;
                --secondary-foreground: 0 0% 98%;
                --muted: 240 3.7% 15.9%;
                --muted-foreground: 240 5% 64.9%;
                --accent: 240 3.7% 15.9%;
                --accent-foreground: 0 0% 98%;
                --destructive: 0 62.8% 30.6%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 3.7% 15.9%;
                --input: 240 3.7% 15.9%;
                --ring: 240 4.9% 83.9%;
            }
        }
    </style>
    <div class="container w-50 p-4">
        <form action="{{ route('reciboCompra') }}" method="POST">
            @csrf


            <div class="flex flex-col md:flex-row p-6">
                <div class="w-full md:w-2/3 pr-4">
                    <h2 class="text-lg font-semibold">Cuenta</h2>
                    <p class="text-muted-foreground">{{ auth()->user()->email }}</p>
                    <h3 class="mt-4 text-md font-semibold">Entrega</h3>
                    <div class="space-y-4">
                        @csrf
                        <input type="hidden" value="{{ auth()->user()->id }}" name="Id_cli">
                        <input type="hidden" value="1" name="Id_Emp">
                        <input type="hidden" value="{{ now()->format('Y-m-d') }}" name="fecha_venta">
                        <input type="hidden" value="Virtual" name="tipo_venta">
                        <input type="hidden" value="Pendiente" name="estado">

                        <div class="row">
                            <div class="col-md-6">
                                <label class="block text-sm font-medium" for="name">Nombre</label>
                                <input type="text" id="name"
                                    class="mt-1 flex w-full border border-border rounded-md p-2"
                                    value="{{ auth()->user()->name }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="block text-sm font-medium" for="name">Apellido</label>
                                <input type="text" id="name"
                                    class="mt-1  w-full border border-border rounded-md p-2"
                                    value="{{ auth()->user()->lastname }}" disabled />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium" for="address">Dirección</label>
                            <input type="text" id="address"
                                class="mt-1 block w-full border border-border rounded-md p-2"
                                value="{{ auth()->user()->direccion }}" disabled />
                        </div>
                        <div>
                            <label class="block text-sm font-medium" for="city">Ciudad</label>
                            <input type="text" id="city"
                                class="mt-1 block w-full border border-border rounded-md p-2"
                                value="{{ auth()->user()->ciudad }}" disabled />
                        </div>
                        <div>
                            <label class="block text-sm font-medium" for="phone">Teléfono</label>
                            <input type="tel" id="phone"
                                class="mt-1 block w-full border border-border rounded-md p-2"
                                value="{{ auth()->user()->telefono }}" disabled />
                        </div>
                    </div>

                    <h3 class="mt-4 text-md font-semibold">Método de envío</h3>
                    <p class="text-muted-foreground">Envío estándar</p>
                    <p class="text-muted-foreground">Costo: $17,000.00</p>

                    <h3 class="mt-4 text-md font-semibold">Pago</h3>
                    <div>
                        <label class="block text-sm font-medium">Método de pago</label>
                        <select class="mt-1 block w-full border border-border rounded-md p-2">
                            <option>Mercado Pago</option>
                            <option>Sinpe</option>
                        </select>
                    </div>

                    <h3 class="mt-4 text-md font-semibold">Dirección de facturación</h3>
                    <div>
                        <input type="checkbox" id="billing-address" />
                        <label class="ml-2" for="billing-address">Usar una dirección de facturación distinta</label>
                    </div>

                    <button class="mt-6 bg-primary text-primary-foreground p-2 rounded-md">Finalizar el pedido</button>
                </div>

                <div class="w-full md:w-1/3 bg-card rounded-lg md:mt-0">

                    <div class="bg-card p-4 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/productos/' . $producto->nombre_imagen . '.jpg') }}"
                                    alt="{{ $producto->nombre }}" class="mr-4 rounded img-thumbnail"
                                    style="width: 100px; height: 100px; object-fit: cover;" />
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold">{{ $producto->nombre }}</h2>
                                <input type="hidden" name="productos[0][Id_producto]"
                                    value="{{ $producto->Id_producto }}">
                                <p class="text-muted-foreground">Cantidad: {{ $cantidad }}</p>
                                <input type="hidden" name="productos[0][cantidad_producto]" value="{{ $cantidad }}">

                                <p class="text-muted-foreground">Talla: {{ $tallaName->talla }}</p>
                                <input type="hidden" name="productos[0][talla_producto]" value="{{ $tallaName->talla }}">

                                <p class="text-primary">$ {{ $producto->precio * $cantidad }}.00</p>


                            </div>

                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-muted-foreground">Subtotal</span>
                            <span class="text-primary">$ {{ $producto->precio * $cantidad }}.00</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-muted-foreground">Métodos de envío</span>
                            <span class="text-primary">$ 17.000,00</span>
                        </div>
                        <div class="flex justify-between font-bold">
                            <span>Total</span>
                            <span class="text-primary">COP $ {{ $producto->precio * $cantidad + 17000 }}.00</span>
                            <input type="hidden" name="">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
