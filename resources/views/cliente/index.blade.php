@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center text-primary">Ropa</h1>
        <p class="text-center text-muted-foreground">Colección exclusiva de The Perla disponibles para entrega inmediata.</p>
        <div class="flex justify-between mt-4">
            <div>
                <label for="filter" class="text-muted-foreground">Filtrar:</label>
                <select id="filter" class="border border-border rounded p-2">
                    <option value="marca">Marca</option>
                    <option value="talla">Talla</option>
                </select>
            </div>
            <div>
                <label for="sort" class="text-muted-foreground">Ordenar por:</label>
                <select id="sort" class="border border-border rounded p-2">
                    <option value="mas_vendidos">Más vendidos</option>
                    <option value="precio">Precio</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">
            <div class="border border-border rounded-lg p-4">
                <img src="https://placehold.co/300x300" alt="Camisa de verano"
                    class="w-full h-48 object-cover rounded-lg" />
                <h2 class="text-lg font-semibold mt-2">Camisa de Verano</h2>
                <p class="text-muted-foreground">$49.900,00 COP</p>
            </div>
            <div class="border border-border rounded-lg p-4">
                <img src="https://placehold.co/300x300" alt="Pantalones de mezclilla"
                    class="w-full h-48 object-cover rounded-lg" />
                <h2 class="text-lg font-semibold mt-2">Pantalones de Mezclilla</h2>
                <p class="text-muted-foreground">$79.900,00 COP</p>
            </div>
            <div class="border border-border rounded-lg p-4">
                <img src="https://placehold.co/300x300" alt="Chaqueta de invierno"
                    class="w-full h-48 object-cover rounded-lg" />
                <h2 class="text-lg font-semibold mt-2">Chaqueta de Invierno</h2>
                <p class="text-muted-foreground">$99.900,00 COP</p>
            </div>
            <div class="border border-border rounded-lg p-4">
                <img src="https://placehold.co/300x300" alt="Vestido de noche"
                    class="w-full h-48 object-cover rounded-lg" />
                <h2 class="text-lg font-semibold mt-2">Vestido de Noche</h2>
                <p class="text-muted-foreground">$129.900,00 COP</p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded">Ver más
                productos</button>
        </div>
    </div>
    <footer class="bg-background text-muted-foreground p-4 mt-6">
        <div class="container mx-auto text-center">
            <p>© 2024, The Perla Store. Todos los derechos reservados.</p>
            <a href="#" class="text-primary">Política de reembolsos</a> | <a href="#"
                class="text-primary">Política de privacidad</a> |
            <a href="#" class="text-primary">Términos del servicio</a>
        </div>
    </footer>
@endsection
