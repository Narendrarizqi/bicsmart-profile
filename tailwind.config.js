import defaultTheme from 'tailwindcss/defaultTheme';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/Models/**/*.php',
        './config/bicsmart.php',
    ],
    theme: {
        extend: {
            colors: {
                // Institutional Trust — Deep Navy #0A2864
                navy: {
                    DEFAULT: '#0A2864',
                    50: '#EEF3FB',
                    100: '#D9E3F5',
                    200: '#B3C6EA',
                    300: '#7F9DD6',
                    400: '#4C72BE',
                    500: '#2A52A3',
                    600: '#1A3E87',
                    700: '#123274',
                    800: '#0A2864',
                    900: '#071D4A',
                    950: '#04112E',
                },
                // Biotech Innovation — Emerald #10B981 (= emerald-500) & Cyan #06B6D4 (= cyan-500)
                brand: {
                    navy: '#0A2864',
                    emerald: '#10B981',
                    cyan: '#06B6D4',
                    leaf: '#3A8C1E', // hijau logotype BiC-SMART
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                bento: '1.5rem',
            },
            boxShadow: {
                bento: '0 1px 2px rgba(10,40,100,.04), 0 8px 24px -12px rgba(10,40,100,.18)',
                'bento-hover': '0 2px 4px rgba(10,40,100,.06), 0 20px 40px -16px rgba(10,40,100,.28)',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0) rotate(-1deg)' },
                    '50%': { transform: 'translateY(-14px) rotate(1deg)' },
                },
                'pop-in': {
                    '0%': { opacity: 0, transform: 'scale(.85) translateY(6px)' },
                    '100%': { opacity: 1, transform: 'scale(1) translateY(0)' },
                },
            },
            animation: {
                float: 'float 6s ease-in-out infinite',
                'pop-in': 'pop-in .35s cubic-bezier(.2,.9,.3,1.2) both',
            },
        },
    },
    plugins: [typography],
};
