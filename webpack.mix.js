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

mix.combine([
        'resources/assets/web/css/base.css',
        'resources/assets/web/css/common.css',
        'resources/assets/web/css/index.css',
        'resources/assets/web/css/setting.css',
    ], 'public/css/app.css')
    .js('resources/assets/web/js/app.js', 'public/js');


//mix.js('resources/assets/admin/js/app.js', 'public/adm/js/app.js')
//    .sass('resources/assets/admin/sass/app.scss', 'public/adm/css/app.css');

mix.version();
