/** @type {import('tailwindcss').Config} */
export default {
darkMode: 'class',
content: [
"./resources/**/*.blade.php",
"./resources/**/*.js",
],
theme: {
extend: {
colors: {
'bg-body': '#F0F0F0', // contoh, sesuaikan warna yang Anda inginkan
'test-bg-body-light': '#F0F0F0',
'test-bg-body-dark': '#202020',
'test-text-light': '#333333',
'test-text-dark': '#E0E0E0',
},
fontFamily: {
// Ambil dari file config Anda sebelumnya jika ini tidak menyebabkan masalah
sans: ['Inter', 'sans-serif'],
},
},
},
plugins: [
require('@tailwindcss/forms'),
],
}
