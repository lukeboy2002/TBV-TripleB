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
                'secondary': '#374151',
                'error': '#C81E1E',
                'success': '#0E9F6E',
            },
            height: {
                '124': '31rem',
            },
            typography: ({theme}) => ({
                orange: {
                    css: {
                        '--tw-prose-body': theme('colors.orange[800]'),
                        '--tw-prose-headings': theme('colors.orange[900]'),
                        '--tw-prose-lead': theme('colors.orange[700]'),
                        '--tw-prose-links': theme('colors.orange[900]'),
                        '--tw-prose-bold': theme('colors.orange[900]'),
                        '--tw-prose-counters': theme('colors.orange[600]'),
                        '--tw-prose-bullets': theme('colors.orange[400]'),
                        '--tw-prose-hr': theme('colors.orange[300]'),
                        '--tw-prose-quotes': theme('colors.orange[900]'),
                        '--tw-prose-quote-borders': theme('colors.orange[300]'),
                        '--tw-prose-captions': theme('colors.orange[700]'),
                        '--tw-prose-code': theme('colors.orange[900]'),
                        '--tw-prose-pre-code': theme('colors.orange[100]'),
                        '--tw-prose-pre-bg': theme('colors.orange[900]'),
                        '--tw-prose-th-borders': theme('colors.orange[300]'),
                        '--tw-prose-td-borders': theme('colors.orange[200]'),
                        '--tw-prose-invert-body': theme('colors.orange[200]'),
                        '--tw-prose-invert-headings': theme('colors.white'),
                        '--tw-prose-invert-lead': theme('colors.orange[300]'),
                        '--tw-prose-invert-links': theme('colors.white'),
                        '--tw-prose-invert-bold': theme('colors.white'),
                        '--tw-prose-invert-counters': theme('colors.orange[400]'),
                        '--tw-prose-invert-bullets': theme('colors.orange[600]'),
                        '--tw-prose-invert-hr': theme('colors.orange[700]'),
                        '--tw-prose-invert-quotes': theme('colors.orange[100]'),
                        '--tw-prose-invert-quote-borders': theme('colors.orange[700]'),
                        '--tw-prose-invert-captions': theme('colors.orange[400]'),
                        '--tw-prose-invert-code': theme('colors.white'),
                        '--tw-prose-invert-pre-code': theme('colors.orange[300]'),
                        '--tw-prose-invert-pre-bg': 'rgb(0 0 0 / 50%)',
                        '--tw-prose-invert-th-borders': theme('colors.orange[600]'),
                        '--tw-prose-invert-td-borders': theme('colors.orange[700]'),
                    }
                }
            }),
        },
    },

    plugins: [
        forms,
        typography,
        require('flowbite/plugin')
    ],
};
