import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react'; // 1. Tambahkan import react

export default defineConfig({
    plugins: [
        laravel({
            // 2. Ubah resources/js/app.js menjadi app.jsx jika kamu menggunakan JSX
            input: ['resources/css/app.css', 'resources/js/app.jsx'], 
            refresh: true,
        }),
        react(), // 3. Pasang plugin react di sini
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});