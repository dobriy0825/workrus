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
mix.js('resources/js/entry_points/worker/create_worker.js', 'public/js/worker/create_worker.js');
mix.js('resources/js/entry_points/worker/item_worker.js', 'public/js/worker/item_worker.js');
mix.js('resources/js/entry_points/job/item_job.js', 'public/js/job/item_job.js');
mix.js('resources/js/entry_points/login.js', 'public/js/login.js');

mix.js('resources/js/entry_points/cabinet/settings.js', 'public/js/cabinet/settings.js');
mix.js('resources/js/entry_points/cabinet/my_worker.js', 'public/js/cabinet/my_worker.js');
mix.js('resources/js/entry_points/cabinet/jobs.js', 'public/js/cabinet/jobs.js');

mix.js('resources/js/app.js', 'public/js/app.js').version();
    mix.styles(['resources/css/style.css',
            'resources/css/mobile.css',
            'resources/css/pc.css',
            'resources/css/other.css',
            'resources/css/worker/popup/selectJob.css',
            'resources/css/calendar.css',
            'resources/css/modal_windows/item_selection.css',
            'resources/css/modal_windows/common/modal_window.css',
            'resources/css/auth/login/switcher_field.css'], 'public/css/app.css').version();
mix.browserSync('http://workrus/');
