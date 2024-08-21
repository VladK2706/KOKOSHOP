import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/producto.js',
                'resources/js/ventas.js',
                'resources/js/validaciones/registrar_usuario.js'

            ],
            refresh: true,
        }),
    ],
});
