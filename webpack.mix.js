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

mix.js('resources/js/entry_points/main.js', 'public/js/main.js');
mix.js('resources/js/entry_points/all.js', 'public/js/all.js');
mix.js('resources/js/entry_points/worker/item_worker.js', 'public/js/worker/item_worker.js');
mix.js('resources/js/entry_points/job/item_job.js', 'public/js/job/item_job.js');
mix.js('resources/js/entry_points/login.js', 'public/js/login.js');
mix.js('resources/js/app.js', 'public/js/app.js');
    mix.styles(['resources/css/style.css',
            'resources/css/mobile.css',
            'resources/css/pc.css',
            'resources/css/calendar.css',
            'resources/css/auth/login/switcher_field.css'], 'public/css/app.css');
