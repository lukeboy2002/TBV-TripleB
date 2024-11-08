import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js'
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'heading': ['"montserrat"'],
            },
            colors: {
                'menu': '#201e1d',
                'dark': '#494746',
                'light': '#e5e7eb',
                'primary': '#f97316',
            },
            height: {
                '124': '31rem',
            }
        },
    },

    plugins: [
        forms,
        typography,
        require('flowbite/plugin')
    ],
};
