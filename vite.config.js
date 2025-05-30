import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        https: true, // for dev (optional)
    },
    build: {
        manifest: true,
        outDir: 'public/build',
    },
    base: '', // keep blank for Laravel root
});
