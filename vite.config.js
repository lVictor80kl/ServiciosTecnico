// filepath: vite.config.js
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': resolve(__dirname, './src'), // Alias para rutas
    },
  },
  server: {
    port: 3000, // Cambia el puerto aquí
  },
});