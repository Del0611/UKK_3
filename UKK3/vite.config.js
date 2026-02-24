import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Agar bisa diakses dari luar localhost
        hmr: {
            host: '192.168.1.39', // Ganti dengan IP Laptop kamu
        },
    },
});