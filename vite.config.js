import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/css/aside.css', 'resources/js/custom.js', 'resources/js/parallax.js', 'resources/js/music.js', 'resources/js/aside.js'],
            refresh: true,
        }),
    ],
});
