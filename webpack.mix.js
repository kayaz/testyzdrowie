const mix = require('laravel-mix');

require('laravel-mix-webp')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('../dist');

mix
    .ImageWebp({
        from: 'resources/images/webp',
        to: 'public/images/webp',
        imageminWebpOptions: {
            quality: 80
        },
    })
    .copy('resources/images/webp', 'public/images')
    .copy('resources/images/png', 'public/images')
    .copy('resources/images/svg', 'public/images')
    .minify('resources/js/app.js')
    .copy('resources/js/app.min.js', 'public/js/app.min.js');
