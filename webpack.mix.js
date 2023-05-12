const mix = require('laravel-mix');

mix.setPublicPath('dist')
   .js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css', [
       require('tailwindcss')
   ]);