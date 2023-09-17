import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        './vendor/bezhansalleh/filament-exceptions/resources/views/**/*.blade.php',
        './vendor/bezhansalleh/filament-language-switch/resources/views/language-switch.blade.php',
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
