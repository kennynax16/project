import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            // Указываем входные точки: CSS и JS файлы
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        http: true,
        host: 'my-laravel-project.loc',
        port: 5174,
        cors: true
      }
      
});
