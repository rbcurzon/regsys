import flowbite from "flowbite/plugin";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            backgroundImage: {
                'search': "url('https://img.icons8.com/?size=100&id=132&format=png&color=000000')",
            },
            colors: {
                blue: {
                    900: '#000055'
                }
            },
        },
    },
    plugins: [
        // require('@tailwindcss/forms'),
        flowbite,
    ],
}

