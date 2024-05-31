import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~iti': __dirname + '/node_modules/intl-tel-input',
            '~animate': __dirname + '/node_modules/animate.css',
            '~flatpickr': __dirname + '/node_modules/flatpickr',
        },
    },
    server: {
        host: true,
        hmr: {
            host: 'localhost',
        }
    }
});
