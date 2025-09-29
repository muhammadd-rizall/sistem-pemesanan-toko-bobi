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
                'sage': '#A3B18A',
                'cream': '#DAD7CD',
                'slate-green': '#344E41',
                'soft-white': '#FAFAFA',
            },
        },
    },
    plugins: [],
}
