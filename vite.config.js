import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'], // Ajusta según tus archivos
            refresh: true,
            base: process.env.APP_URL || 'http://localhost:8000',
        }),
    ],
}); 