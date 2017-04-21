const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {
    mix.less([ 'general.less', 'fields.less','app.less'])
       .webpack([
           'classes/models.js',
           'classes/brends.js',
           'classes/parts.js',
           'classes/clients.js',
           'classes/errors.js',
           'classes/types.js',
           'app.js']);
});
