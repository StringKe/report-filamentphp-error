import forms from '@tailwindcss/forms';
import preset from './vendor/filament/support/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],

    content: [
        './vendor/laravel/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './app/Filament/**/*.php',
        './lang/**/*.php',
    ],

    theme: {},

    plugins: [forms],
};
