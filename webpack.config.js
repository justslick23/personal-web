const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .webpackConfig({
       plugins: [
           new BrowserSyncPlugin({
               proxy: '127.0.0.1:923', // Adjust this if using Valet or a different host
               files: [
                   'app/**/*.php',
                   'resources/views/**/*.blade.php',
                   'routes/**/*.php',
                   'public/js/**/*.js',
                   'public/css/**/*.css'
               ],
               notify: false
           })
       ]
   });

mix.version();
