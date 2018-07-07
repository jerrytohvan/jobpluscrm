let mix = require('laravel-mix');
let minifier = require('minifier');

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
   .js('src/js/custom.js', 'public/js/')
   .js('src/js/jobplus_app.js', 'public/js/')
   .js('node_modules/datejs/index.js', 'public/js/date.js')
   .sass('src/scss/custom.scss', 'public/css/').version();

   //
   // mix.then(() => {
   //     minifier.minify('src/css/custom.css')
   // });

   mix.autoload({
       jquery: ['$', 'window.jQuery', 'jQuery', 'jquery']
        });
