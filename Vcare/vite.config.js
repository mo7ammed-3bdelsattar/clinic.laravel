import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  server: {
    host: 'localhost',
    port: 5173,
    https: false, // تأكد إنها false لو مش عامل شهادة
    hmr: {
      protocol: 'ws',
      host: 'localhost',
    },
  },
});
