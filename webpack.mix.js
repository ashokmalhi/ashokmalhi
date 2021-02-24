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

const paths = {
    'jqueryvalidate': './node_modules/jquery-validation/',
}

mix.js('resources/js/app.js', 'public/js');

//.sass('resources/sass/app.scss', 'public/css');
    
mix.styles([
    'public/css/bootstrap.min.css',
    'public/css/style.css',
    
], 'public/css/master.css').version();    

mix.scripts([
    'public/js/jquery.min.js',
    'public/js/bootstrap.min.js',
    'public/js/main.js',
    'public/js/chart.js/Chart.min.js',
    'public/js/charts.js',
    paths.jqueryvalidate + "dist/jquery.validate.min.js",
    paths.jqueryvalidate + "dist/additional-methods.min.js",
    'public/js/custom.js',
    
], 'public/js/master.js').version();