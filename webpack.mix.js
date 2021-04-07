const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/jquery.easing.js', 'public/vendor/jquery-easing')
    .js('resources/js/jquery.js', 'public/vendor/jquery')
    .js('resources/js/bootstrap.bundle.js', 'public/vendor/bootstrap/js')
    .js('resources/js/sb-admin.js', 'public/js')
    .sass('resources/sass/_login.scss', 'public/css')
    .sass('resources/sass/_mixins.scss', 'public/css')
    .sass('resources/sass/_utilities.scss', 'public/css')
    .sass('resources/sass/_variables.scss', 'public/css')
    .sass('resources/sass/sb-admin.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');
