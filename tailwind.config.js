import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'surface': 'var(--color-surface)',
                'surface-2': 'var(--color-surface-2)',
                'card': 'var(--color-card)',
                'card-solid': 'var(--color-card-solid)',
                'border-light': 'var(--color-border-light)',
                'border-brutal': 'var(--color-border-brutal)',
                'ink': 'var(--color-ink)',
                'ink-light': 'var(--color-ink-light)',
                'ink-muted': 'var(--color-ink-muted)',
                'accent': '#34d399',
                'accent-dark': '#059669',
                'accent-light': '#6ee7b7',
                'brutal-shadow': 'var(--color-brutal-shadow)',
            },
            boxShadow: {
                'glass': '0 4px 30px rgba(0, 0, 0, 0.05)',
                'glass-lg': '0 8px 40px rgba(0, 0, 0, 0.08)',
                'brutal': '4px 4px 0px rgba(0, 0, 0, 0.9)',
                'brutal-sm': '2px 2px 0px rgba(0, 0, 0, 0.9)',
                'brutal-accent': '4px 4px 0px #059669',
                'card-hover': '0 12px 40px rgba(0, 0, 0, 0.1)',
            },
            borderRadius: {
                '2xl': '1rem',
                '3xl': '1.5rem',
            },
        },
    },

    plugins: [forms],
};
