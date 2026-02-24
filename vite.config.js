import { defineConfig } from 'vite';
import { resolve } from 'path';
import { createVuePlugin } from 'vite-plugin-vue2';

export default defineConfig({
  plugins: [createVuePlugin()],
  root: __dirname,
  publicDir: false,
  build: {
    outDir: 'source/assets/build',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: resolve(__dirname, 'source/_assets/js/main.js'),
      output: {
        entryFileNames: 'js/[name]-[hash].js',
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
          return assetInfo.name?.endsWith('.css')
            ? 'css/[name]-[hash][extname]'
            : 'assets/[name]-[hash][extname]';
        },
      },
    },
    sourcemap: true,
  },
  css: {
    preprocessorOptions: {
      scss: {
        loadPaths: [resolve(__dirname, 'node_modules')],
      },
    },
  },
  resolve: {
    alias: {
      '~': resolve(__dirname, 'source/_assets'),
    },
  },
  server: {
    port: 5173,
    strictPort: true,
  },
});
