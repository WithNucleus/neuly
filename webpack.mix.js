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

// Mix JavaScript
mix
	.js('resources/js/app.js', 'public/js')
	.js('resources/js/discovertabs.js', 'public/js')
	.js('resources/js/formValidation.js', 'public/js');

// Mix CSS
mix
	.sass('resources/sass/app.scss', 'public/css')
	.sass('resources/sass/index-qm.scss', 'public/css')
	.sass('resources/sass/datatables.scss', 'public/css');

// Copy Images
mix.copyDirectory('resources/images', 'public/images');

// Copy Public Assets
mix.copyDirectory('resources/assets', 'public/assets');

mix.version();
