//デフォルトのコード
//import { defineConfig } from 'vite';
//import laravel from 'laravel-vite-plugin';
//import tailwindcss from '@tailwindcss/vite';

//export default defineConfig({
//    plugins: [
//        laravel({
//            input: ['resources/css/app.css', 'resources/js/app.js'],
//            refresh: true,
//        }),
//        tailwindcss(),
//    ],
//    server: {
//        watch: {
//            ignored: ['**/storage/framework/views/**'],
//        },
//    },
//});

//ワードのコード
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  server: {
    host: '0.0.0.0',        // ← IPv6 [::] を防ぐ
    port: 5173,
    hmr: {
      host: 'localhost',   // ← Laravel に教える正しいURL
    },
  },
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/top_app.ts',
        'resources/js/login_app.ts',
      ],
      refresh: true,
    }),
    vue(),
  ],
})

//Laravel sailのコード
//import { defineConfig } from 'vite';
//import laravel from 'laravel-vite-plugin';
//import vue from '@vitejs/plugin-vue';

//export default defineConfig({
//    plugins: [
//        laravel({
//            input: ['resources/css/app.css', 'resources/js/top_app.ts', 'resources/js/login_app.ts', 'resources/js/entry.js'], // TS エントリ
//            refresh: true,
//        }),
//        vue(),
//    ],
//    resolve: {
//        alias: {
//            '@': '/resources/js', // TS で @/components などが使える
//            'vue': 'vue/dist/vue.esm-bundler.js', // ここでエイリアスを追加
//        },
//    },
//});
