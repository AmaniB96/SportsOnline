import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/equipe.css','resources/css/home.css', 'resources/js/app.js', 'resources/css/equipe-detail.css','resources/css/joueur.css','resources/css/equipe-show.css'],
            refresh: true,
        }),
    ],
});
