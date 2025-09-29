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
                // Palet warna baru yang lebih kaya
                'sage': {
                    '50': '#f6f8f6',  // Sangat terang (hampir putih)
                    '100': '#e8f0e8', // Abu-abu kehijauan
                    '200': '#d1e1d1', // Abu-abu sage
                    '300': '#a8c9a8', // Sage pucat
                    '400': '#7eb17e', // Sage utama
                    '500': '#5f9964', // Sage yang lebih hidup
                    '600': '#4a7c59', // Sage gelap (untuk tombol)
                    '700': '#3d6649', // Lebih gelap
                    '800': '#2f4f39', // Paling gelap (untuk footer/teks)
                    '900': '#1f3327', // Hampir hitam
                },
                'cream': '#f5f5f0',    // Warna dasar latar belakang yang hangat
                'warm-gray': '#31363F', // Untuk teks utama yang kontras
                'accent': '#E78895',   // Warna aksen lembut (opsional)
            },
            fontFamily: {
                // Menambahkan font yang sudah Anda panggil di layout
                'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                'serif': ['Playfair Display', 'ui-serif'],
            }
        },
    },
    plugins: [],
}
