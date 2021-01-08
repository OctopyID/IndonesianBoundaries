const mix = require('laravel-mix');
const LiveReload = require("webpack-livereload-plugin");

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

mix.webpackConfig({
    plugins: [
        new LiveReload()
    ]
});

mix.setPublicPath('public')
    .sass('resources/css/app.scss', 'public/app.css').sourceMaps()
    .ts('resources/js/App.ts', 'public/app.js').sourceMaps()
    .version()
    .copy('public', '../public/vendor/octopyid/boundary');