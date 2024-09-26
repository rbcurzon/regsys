/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                blue: {
                    900: '#221c66'
                }
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

