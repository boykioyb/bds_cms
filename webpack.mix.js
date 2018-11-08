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
mix.styles([
    'public/assets/vendors/base/vendors.bundle.css',
    'public/assets/demo/default/base/style.bundle.css',
    'public/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css',
], 'public/css/all.css');

mix.styles([
    'public/css/animate.min.css',
    'public/css/fancybox/jquery.fancybox-1.3.4.css',
    'public/css/prettyPhoto.css',
], 'public/css/file_manager.css');

mix.js([
    'public/js/jquery.min.js',
    'public/js/bootstrap.min.js',
],'public/js/jquery.bootstrap.js');

mix.js([
    'public/js/jquery.easing.js',
    'public/js/jquery.prettyPhoto-3.1.4-W3C.js',
    'public/js/jquery.ui.totop.js',
    'public/js/jquery.inview.js',
    'public/js/jquery.parallax-1.1.3.js',
    'public/js/jquery.localscroll-1.2.7-min.js',
    'public/js/jquery.scrollTo-1.4.2-min.js',
    'public/js/jquery.fancybox-1.3.4.pack.js',
    'public/js/jquery.fitvids.min.js',
    'public/js/jquery.nicescroll.min.js',
],'public/js/file_manager.js');



// mix.js('resources/js/app.js', 'public/js');
