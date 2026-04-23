import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
