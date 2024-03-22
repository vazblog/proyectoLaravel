const mix = require('laravel-mix');

// Compilar archivos CSS por separado
mix.combine([
   'resources/css/material-kit.css',
   'resources/css/material-kit.min.css',
   'resources/css/material-kit.icons.css',
   'resources/css/nucleo-svg.css'
], 'public/assets/css/combined.css');

mix.js('resources/js/app.js', 'public/js');

