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
                blackSimple: '#24282F',
                blackBack: '#1E1E24',
                blackActive: 'rgba(53,56,91,1)',
                // box-shadow: 0px 2px 4px rgba(0,0,0,0.2), 0px 0px 6px rgba(0,0,0,0.1);``
                darkblue: 'rgba(6,1,54,0.9)',
                darkblue2: 'rgba(6,1,54,1)',
                darkblue3: 'rgb(0,0,35)',
            },
            fontFamily: {
                main: ['Open Sans', 'Raleway'],
            },
            spacing: {
                HD: '1280px',
                FullHD: '1920px',
                '2K': '2560px',
                '100%': '100%',
                '95%': '95%',
                '90%': '90%',
                '85%': '85%',
                '80%': '80%',
                '75%': '75%',
                '70%': '70%',
                '65%': '65%',
                '60%': '60%',
                '55%': '55%',
                '50%': '50%',
                '45%': '45%',
                '40%': '40%',
                '35%': '35%',
                '30%': '30%',
                '25%': '25%',
                '20%': '20%',
                '15%': '15%',
                '10%': '10%',
                '5%': '5%',
            }
        },
    },

    plugins: [forms, typography, flowbite],
};
