const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage :{
                'section-product' : "url('https://preview.colorlib.com/theme/coffee/img/menu-bg.jpg')",
                'section-vidio' : "url('https://preview.colorlib.com/theme/coffee/img/xvideo-bg.jpg.pagespeed.ic.9DP5dAVXlo.webp')"
            },
            colors : {
                'landing' : "#ff7c57"
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('flowbite/plugin')],
};
