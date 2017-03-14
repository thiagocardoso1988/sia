const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */


var node = './node_modules/';

var paths = {
	'bootstrap': node + 'bootstrap-sass/assets/',
	'fontawesome': node + 'font-awesome/',
}


elixir((mix) => {
    mix
       .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
       .copy(paths.bootstrap + 'javascripts/bootstrap.min.js', 'public/js')
       .copy(paths.fontawesome + 'fonts','public/fonts')
       //.sass('app.scss')
       //.webpack('app.js')

       // public site
       .sass('site/landing-page.scss')
       .sass('site/site.scss')
       .webpack(['app.js', 'site/site.js'], 'public/js/site.js')

       // app site
       .sass('app/app.scss')
       ;
});
