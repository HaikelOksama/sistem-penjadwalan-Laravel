import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // 'resources/dist/css/adminlte.min.css',

                // 'resources/plugins/jquery/jquery.min.js',
                // 'resources/plugins/bootstrap/js/bootstrap.bundle.min.js',
                // 'resources/dist/js/adminlte.min.js'
            ],
            refresh: true,
        }),
    ],
});
