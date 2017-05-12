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

//mix.css([
//    'resources/assets/css/common.css',
//    'resources/assets/css/style.css'
//], 'public/css/all.css');
//mix.css('resources/assets/css/common.css', 'public/css');

mix.combine([
        'resources/assets/css/common.css',
        'resources/assets/css/style.css'
    ], 'public/css/all.css')
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/common.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.version();
