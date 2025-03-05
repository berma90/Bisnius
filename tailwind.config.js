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
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins:['Neue', ],
                sans: ['Neue','Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary50: '#05415F !important',
                card: '#F8F7F7 !important',
                shadow: '#2F8CE3 !important',
            },
        },
    },

    plugins: [forms, typography],
};
