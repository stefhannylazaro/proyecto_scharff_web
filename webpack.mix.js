let mix = require('laravel-mix');
// const HtmlWebpackPlugin = require('html-webpack-plugin');
//
// var PrerenderSPAPlugin = require('prerender-spa-plugin');
// const Renderer = PrerenderSPAPlugin.PuppeteerRenderer;
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
// console.log(Mix.paths.root('resources/views/home/index.html'));
mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css')
    .stylus('resources/assets/stylus/app.styl', 'public/css');
       // .webpackConfig({
       //     plugins: [
       //      //  new HtmlWebpackPlugin({
       //      //   template: Mix.paths.root('resources/views/home/index.html'),
       //      //   inject: false
       //      // })
       //        new PrerenderSPAPlugin({
       //          // Required - The path to the webpack-outputted app to prerender.
       //          staticDir: (__dirname+'/public'),
       //          // Required - Routes to render.
       //          routes: [ '/' ],
       //          renderAfterTime: 5000,
       //        })
       //     ],
       //   });
