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
                poppins: ["Poppins", "sans-serif"],
            },
            colors: {
                primary10: '#086391',
                primary30: '#065379',
                primary50: '#05415F',
                primary70: '#043249',
                primary90: '#032130',
                secondary10: '#ACE1FC',
                secondary30: '#60B1EE',
                secondary50: '#2F8CE3',
                secondary70: '#1751A3',
                secondary90: '#0E3983',
                netral10: '#D6D6D6',
                netral30: '#CACACA',
                netral50: '#C4C4C4',
                netral70: '#B0B0B0',
                netral90: '#9d9d9d',
                dark10: '#808080',
                dark30: '#666666',
                dark50: '#4C4C4C',
                dark70: '#333333',
                dark90: '#000000',
                card: '#F8F7F7 !important',
            },
        },
    },

    plugins: [forms, typography],
};
