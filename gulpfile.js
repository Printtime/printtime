var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.copy(
        'node_modules/bootstrap-sass/assets/fonts',
        'public/build/fonts'
    ).copy(
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'resources/assets/js'
    ).copy(
        'node_modules/bootstrap-sass/assets/stylesheets',
        'resources/assets/sass'
    ).copy(
        'node_modules/lightbox2/src/css',
        'resources/assets/css'
    ).copy(
        'node_modules/lightbox2/src/js',
        'resources/assets/js'
    ).copy(
        'node_modules/lightbox2/src/images',
        'public/build/images'
    );

    mix.styles([
        'lightbox.css',
    ], 'public/css/all.css');

    mix.sass([
        'app.scss',
        'style.scss'
    ], 'public/css/app.css');


    mix.scripts([
    	'jquery.min.js',
    	'wow.min.js',
        'bootstrap.min.js',
        'lightbox.js',
    	'js.js'
    	], 'public/js/app.js');


    mix.version(['public/css/all.css', 'public/css/app.css', 'public/js/app.js']);


});

// elixir(function(mix) {
//     mix.sass([
//         'app.scss',
//         //'style.scss',
//     ]);

//     mix.version(['public/css/app.css']);
// });
