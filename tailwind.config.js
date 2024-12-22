import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const plugin = require('tailwindcss/plugin');
const rtl = require('tailwindcss-rtl');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // Enable class-based dark mode

    theme: {
        extend: {
            colors: {
                primary: {
                  DEFAULT: '#1a1a1a', // Neutral dark gray as the primary color
                  light: '#2d2d2d',   // Slightly lighter for hover effects
                  dark: '#0f0f0f',    // Darker if needed
                },


                gray: {
                  50: '#fafafa', // Lightest
                  100: '#f5f5f5',
                  200: '#e5e5e5',
                  300: '#d4d4d4',
                  400: '#a3a3a3',
                  500: '#737373',
                  600: '#525252',
                  700: '#404040', // Neutral gray without blue
                  800: '#262626',
                  900: '#171717', // Dark neutral gray
                },

                blue: {
                    50: '#faf8f4', // Lightest
                    100: '#f6f1ea',
                    200: '#ece4d5',
                    300: '#e3d6bf',
                    400: '#dac8aa',
                    500: '#a2762b',
                    600: '#412f11',
                    700: '#31230d',
                    800: '#201809',
                    900: '#100c04' // Darkest
                  }

              },

              fontFamily: {
                sans: ['YekanBakh', 'ui-sans-serif', 'system-ui', 'sans-serif'], // Custom font
                serif: ['YekanBakh', 'ui-sans-serif', 'system-ui', 'sans-serif'], // Custom font
                mono: ['YekanBakh', 'ui-sans-serif', 'system-ui', 'sans-serif'], // Custom font


            },
            },
    },

    plugins: [forms, typography],

    plugins: [
        rtl, // Add RTL plugin
        plugin(function ({ addUtilities }) {
          addUtilities({
            '.ltr': { direction: 'ltr' },
            '.rtl': { direction: 'rtl' },
          });
        }),
      ],



};
