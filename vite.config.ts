import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import { fileURLToPath, URL } from 'node:url'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/js/app.ts'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
            '@/wayfinder': fileURLToPath(new URL('./resources/js/wayfinder', import.meta.url)),
        },
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: process.env.HMR_HOST || 'localhost',
            port: 5173,
        },
    },
})
