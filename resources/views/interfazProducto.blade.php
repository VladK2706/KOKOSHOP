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
</head>

<body>

    <hr>
    <div class="py-4 flex flex-col md:flex-row bg-white dark:bg-card rounded-lg shadow-lg p-6 container">
        <div class="flex-1">
            <img src="{{ asset('images/productos/' . $producto->nombre_imagen . '.jpg') }}" alt="{{$producto->nombre_imagen}}" class="w-full h-auto rounded-lg" />
        </div>
        <div class="flex-1 md:pl-6">
            <h1 class="text-2xl font-bold text-primary">{{ $producto->nombre }}</h1>


            <p class="mt-4 text-xl font-semibold text-primary">$ {{$producto->precio}} COP</p>

            <label for="size" class="mt-4 block text-muted">Tamaño</label>
            <select id="size" class="mt-1 block w-full border border-border rounded-md p-2">
                <option value="">Seleccionar Tallas</option>
                @foreach ($producto->tallas as $talla)
                <option value="{{ $talla->talla }}">{{ $talla->talla }}</option>
                @endforeach
            </select>

            <label for="quantity" class="mt-4 block text-muted">Cantidad</label>
            <div class="flex items-center mt-1">
                <button id="decrement" class="bg-secondary text-secondary-foreground rounded-l-md px-4">-</button>
                <input type="number" id="quantity" name="talla" value="1" class="border border-border text-center w-16" />
                <button id="increment" class="bg-secondary text-secondary-foreground rounded-r-md px-4">+</button>
            </div>


            <div class="mt-6 flex space-x-4">
                <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 rounded-md py-2 w-full">Agregar al carrito</button>
                <a href="{{ route('compra.formulario', $producto->Id_producto) }}">
                    <button class="bg-primary text-primary-foreground hover:bg-primary/80 rounded-md py-2 w-full">Comprar ahora</button>
                </a>
            </div>
        </div>
    </div>

    <script>
      // Selecciona los elementos
      const quantityInput = document.getElementById('quantity');
      const decrementButton = document.getElementById('decrement');
      const incrementButton = document.getElementById('increment');

      // Añade los manejadores de eventos
      decrementButton.addEventListener('click', () => {
          // Obtiene el valor actual del input
          let currentValue = parseInt(quantityInput.value);
          // Decrementa el valor (asegúrate de que el valor no sea menor que 1)
          if (currentValue > 1) {
              quantityInput.value = currentValue - 1;
          }
      });

      incrementButton.addEventListener('click', () => {
          // Obtiene el valor actual del input
          let currentValue = parseInt(quantityInput.value);
          // Incrementa el valor
          quantityInput.value = currentValue + 1;
      });
  </script>
    @endsection