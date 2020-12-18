const mix = require('laravel-mix');
const liveReload = require("webpack-livereload-plugin");

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

mix.disableSuccessNotifications();

mix.webpackConfig({
    plugins: [
        new liveReload()
    ]
});

mix.setPublicPath('public')
    .sass('resources/css/app.scss', 'public/app.css')
    .ts('resources/js/App.ts', 'public/app.js')
    .version()
    .copy('public', '../public/vendor/octopyid/boundary')
    .webpackConfig({
        resolve: {
            symlinks: false,
            alias: {
                '@': path.resolve(__dirname, 'resources/js/'),
            },
        },
    });