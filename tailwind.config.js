// tailwind.config.js
const colors = require('tailwindcss/colors')

  module.exports = {
   purge: [
     './resources/**/*.blade.php',
     './resources/**/*.js',
     './resources/**/*.vue',
   ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                futura: ['Futura', 'Trebuchet MS', 'Aria' , 'sans-serif'],
            },
            textColor: {
                'light-grey': '#EAEBEB',
                'you-grey': '#2C2C2C',
                'primary-100': '#ee9e8f',
                'primary-500': '#F2715A',
                'primary-900': '#db5138',
            },
            backgroundColor: {
                'light-grey': '#EAEBEB',
                'you-grey': '#2C2C2C',
                'primary-100': '#ee9e8f',
                'primary-500': '#F2715A',
                'primary-900': '#db5138',
            },
            gradientColorStops: {
                'light-grey': '#EAEBEB',
                'you-grey': '#2C2C2C',
                'primary-100': '#ee9e8f',
                'primary-500': '#F2715A',
                'primary-900': '#db5138',
            },
            borderColor: {
                'light-grey': '#EAEBEB',
                'you-grey': '#2C2C2C',
                'primary-100': '#ee9e8f',
                'primary-500': '#F2715A',
                'primary-900': '#db5138',
            },
            ringColor: {
                'light-grey': '#EAEBEB',
                'you-grey': '#2C2C2C',
                'primary-100': '#ee9e8f',
                'primary-500': '#F2715A',
                'primary-900': '#db5138',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
  }
