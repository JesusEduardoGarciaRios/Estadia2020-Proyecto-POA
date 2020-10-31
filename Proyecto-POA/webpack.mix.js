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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/css/all.min.css',
    'resources/assets/css/tempusdominus-bootstrap-4.min.css',
    'resources/assets/css/icheck-bootstrap.min.css',
    'resources/assets/css/adminlte.min.css',
    'resources/assets/css/OverlayScrollbars.min.css',
    'resources/assets/css/daterangepicker.css',
    'resources/assets/css/summernote-bs4.css'], 
    'public/css/plantilla.css')

    .scripts([
        'resources/assets/js/jquery.min.js',
        'resources/assets/js/jquery-ui.min.js',
        'resources/assets/js/bootstrap.bundle.min.js',
        'resources/assets/js/Chart.min.js',
        'resources/assets/js/jquery.knob.min.js',
        'resources/assets/js/moment.min.js',
        'resources/assets/js/daterangepicker.js',
        'resources/assets/js/tempusdominus-bootstrap-4.min.js',
        'resources/assets/js/summernote-bs4.min.js',
        'resources/assets/js/jquery.overlayScrollbars.min.js',
        'resources/assets/js/adminlte.js',
        'resources/assets/js/sweetalert2.all.min.js'], 
        'public/js/plantilla.js')

        .js(['resources/js/app.js'], 'public/js/app.js');