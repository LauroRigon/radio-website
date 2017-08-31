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
//dashboard
mix.js('resources/assets/js/dashboard/app.js', 'public/js/dashboard')
    .sass('node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss', 'public/css/bootstrap.css')
    .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css/font-awesome.css')
    .combine([
       'resources/assets/css/dashboard/skins/skin-blue.css',
       'resources/assets/css/dashboard/AdminLTE.css',
       'public/css/font-awesome.css',
       'node_modules/animate.css/animate.min.css',
       'node_modules/toastr/build/toastr.min.css',
       'node_modules/flickity/dist/flickity.min.css',
       'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
       'resources/assets/css/dashboard/jConfirm/jConfirm.css',
    ], 'public/css/dashboard/all.css')
    .combine([
       'resources/assets/js/dashboard/adminLTEapp.js',
     //  'node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
       'resources/assets/js/vendor/jConfirm/jConfirm.js',
    ], 'public/js/dashboard/all.js')
    .copy('node_modules/font-awesome/fonts/*.*', 'public/fonts/')
    .copy('node_modules/ionicons/dist/fonts/*.*', 'public/fonts/');

//'front'
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .combine([
      'public/css/font-awesome.css',
      'node_modules/animate.css/animate.min.css',
      'node_modules/flickity/dist/flickity.min.css',
//      'node_modules/icheck/skins/square/square.css',
//      'node_modules/icheck/skins/square/blue.css',
//      'resources/assets/css/bootstrap.min.css',
      
      ], 'public/css/all.css');