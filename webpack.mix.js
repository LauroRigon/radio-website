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
mix.js('resources/assets/js/dashboard/app.js', 'public/dashboard/js')
    .sass("resources/assets/sass/dashboard/app.scss", "public/dashboard/css")
    .copy('node_modules/font-awesome/fonts/*.*', 'public/fonts/')
    .copy('node_modules/ionicons/dist/fonts/*.*', 'public/fonts/')
    .copy('resources/assets/js/dashboard/plugins/ckeditor', 'public/dashboard/plugins/ckeditor');
    

//home
mix.js('resources/assets/js/home/app.js', 'public/home/js')
    .sass('resources/assets/sass/home/app.scss', 'public/home/css');