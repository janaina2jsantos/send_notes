const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-blue-500',
        'bg-blue-900',
        'bg-gray-100',
        'bg-gray-300',
        'bg-gray-400',
        'bg-gray-800',
        'bg-indigo-50',
        'bg-white',
        'bg-green-50',
        'bg-green-100',
        'bg-red-50',
        'bg-red-100',
        'bg-rose-400',
        'bg-rose-700',
        'border-green-400',
        'border-red-400',
        'text-green-700',
        'text-red-700',
        'w-24',
        'w-1/2',
        'top-6',
        'left-1/4',
        'sm'
    ],
    theme: {
        extend: {
            screens: {
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px'
            },
            width: {
                '24': '6rem',
                '28': '7rem',
                '32': '8rem',
                '60': '15rem',
                '1/2': '50%'
            },
            height: {
                '24': '6rem',
                '28': '7rem',
                '32': '8rem',
                '60': '15rem'
            },
            top: {
                '6': '1.5rem'
            },
            left: {
                '1/4': '25%'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
