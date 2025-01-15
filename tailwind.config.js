import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                maroon :'#451A14',
                maroon2: '#6e3228',
                maroon3: '#d77f6b',
                bone: '#ffebe1'
            },


            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                antiquity: ['Inknut Antiqua', 'serif'],
                italianno: ['Italianno', 'cursive'],             
            },
        },
    },
    plugins: [],
};
