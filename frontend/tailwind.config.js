/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
    "./node_modules/flowbite/**/*.{js,ts}",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {

        themeBackground: 
        'var(--background)'
        ,
                themeText: 
        'var(--text)'
        ,
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

