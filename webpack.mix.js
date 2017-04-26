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
    .combine([
        'public/css/app.css',
        'node_modules/admin-lte/dist/css/skins/_all-skins.css',
        'public/css/adminlte-app.css',
        'node_modules/icheck/skins/square/blue.css',
        'public/css/toastr.css'
    ], 'public/css/all.js')
