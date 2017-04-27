const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss', 'public/css/bootstrap.css')
   .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css/font-awesome.css')
   .combine([
       'resources/assets/css/skins/skin-blue.css',
       'resources/assets/css/AdminLTE.css',
       'public/css/font-awesome.css'
   ], 'public/css/dashboard/all.css')
   .combine([
       'resources/assets/js/adminLTEapp.js',
   ], 'public/js/dashboard/all.js')
    .copy('node_modules/font-awesome/fonts/*.*', 'public/fonts/')
    .copy('node_modules/ionicons/dist/fonts/*.*', 'public/fonts/');
