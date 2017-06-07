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

mix.js('resources/assets/js/dashboard/app.js', 'public/js/dashboard')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss', 'public/css/bootstrap.css')
    .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css/font-awesome.css')
    .combine([
       'resources/assets/css/skins/skin-blue.css',
       'resources/assets/css/AdminLTE.css',
       'public/css/font-awesome.css',
       'node_modules/animate.css/animate.min.css',
       'node_modules/toastr/build/toastr.min.css',
       'resources/assets/css/jConfirm/jConfirm.css',
    ], 'public/css/dashboard/all.css')
    .combine([
       'resources/assets/js/dashboard/adminLTEapp.js',
       'resources/assets/js/vendor/jConfirm/jConfirm.js',
    ], 'public/js/dashboard/all.js')
    .copy('node_modules/font-awesome/fonts/*.*', 'public/fonts/')
    .copy('node_modules/ionicons/dist/fonts/*.*', 'public/fonts/');
