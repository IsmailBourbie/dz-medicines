import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                montserrat: ['Montserrat', ...defaultTheme.fontFamily.sans],
                openSans: ['"Open Sans"', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
