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

//disable creating LICENSE files when run in production mode
mix.options({
    terser: {
        extractComments: false,
    }
});

// Mix JavaScript
mix
	.js('resources/js/app.js', 'public/js')
	// .js('resources/js/discovertabs.js', 'public/js')
	// .js('resources/js/formValidation.js', 'public/js')
    .js('resources/js/appDetailModal.js', 'public/js')
    // .js('resources/js/home-hero.js', 'public/js')
    .js('resources/js/nav-tiles.js', 'public/js')
    .js('resources/js/metrics/bar.js', 'public/js')
    .js('resources/js/metrics/line.js', 'public/js')
    // .js('resources/js/embed-search.js', 'public/js/external')
    .js('resources/js/neuly-care.js', 'public/js')
    .js('resources/js/search.js', 'public/js')
    .js('resources/js/admin.js', 'public/js');

// Mix CSS
mix
	.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/index-qm.scss', 'public/css')
    .sass('resources/sass/backpack-custom.scss', 'public/css')
    .sass('resources/sass/choices.scss', 'public/css')
    .sass('resources/sass/nav-tiles.scss', 'public/css')
    .sass('resources/sass/enterprise-dashboard.scss', 'public/css')
    .sass('resources/sass/algolia.scss', 'public/css');
// mix
// 	.sass('resources/sass/app.scss', 'public/css')
// 	.sass('resources/sass/index-qm.scss', 'public/css')
// 	.sass('resources/sass/datatables.scss', 'public/css')
//     .sass('resources/sass/nav-tiles.scss', 'public/css')
//     .sass('resources/sass/enterprise-dashboard.scss', 'public/css')
//     .sass('resources/sass/embed-search.scss', 'public/css/external')
//     .sass('resources/sass/backpack-custom.scss', 'public/css');

// Copy Images
mix.copyDirectory('resources/images', 'public/images');

// Copy Public Assets
mix.copyDirectory('resources/assets', 'public/assets');

if (mix.inProduction()) {
    mix.version();
}
