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
    mix.sass([
        'app.scss',
        'header.scss',
        'profile.scss',
        'edit.scss',
        'create.scss',
        'product.scss',
        'main.scss',
        'message-show.scss',
        'notification.scss',
    ], 'public/assets/css/style.css');

    mix.version('public/assets/css/style.css');
});
