import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import flowbite from 'flowbite/plugin';

/** @types {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/**/*.js',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        screens: {
            HD: '1280px',
            FullHD: '1920px',
            '2K': '2560px',
            ...defaultTheme.screens
        },
        extend: {
            colors: {
                love: '#EC6161',
                black2: 'rgba(53,56,91,1)',
                // box-shadow: 0px 2px 4px rgba(0,0,0,0.2), 0px 0px 6px rgba(0,0,0,0.1);``
                darkblue: 'rgba(6,1,54,0.9)',
                darkblue2: 'rgba(6,1,54,1)',
                darkblue3: 'rgb(0,0,35)',
            },
            fontFamily: {
                main: ['Open Sans', 'Raleway'],
            },
            spacing: {
                '95': '95%',
            }
        },
    },

    plugins: [forms, typography, flowbite],
};
