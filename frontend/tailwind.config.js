/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    './index.html',
    './src/**/*.{vue,js,ts,jsx,tsx}',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Poppins"', 'ui-sans-serif', 'system-ui']
      },
      colors: {
        brand: {
          DEFAULT: '#8B5E34',
          light: '#D6A574',
          dark: '#5C3B16'
        }
      },
      boxShadow: {
        soft: '0 4px 24px -4px rgba(0,0,0,0.08)',
        glow: '0 0 0 3px rgba(139,94,52,0.25)'
      },
      keyframes: {
        shimmer: {
          '0%': { backgroundPosition: '0% 50%' },
          '100%': { backgroundPosition: '100% 50%' }
        }
      },
      animation: {
        shimmer: 'shimmer 1.5s linear infinite'
      }
    },
  },
  plugins: [
    // require('daisyui'), // Uncomment if daisyui installed
  ],
};
