/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f9f5f0',
          100: '#f0e6d8',
          200: '#e2cdb1',
          300: '#d4b389',
          400: '#c69a62',
          500: '#b8813a', // Màu chính (nâu cafe)
          600: '#a67332',
          700: '#895d2a',
          800: '#6f4e37', // Màu đậm cho header
          900: '#5a3a28',
        },
        secondary: {
          50: '#fefbe8',
          100: '#fff9c2',
          200: '#fff088',
          300: '#ffe144',
          400: '#ffd700', // Màu phụ (vàng)
          500: '#f2b800',
          600: '#d69e00',
          700: '#a97500',
          800: '#8c5e10',
          900: '#784d16',
        },
      },
      fontFamily: {
        sans: ['Figtree', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
