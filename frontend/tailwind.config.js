// /** @type {import('tailwindcss').Config} */
module.export = {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.{js,vue,ts}",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
    "./node_modules/flowbite/**/*.{js,ts}",
    "./nuxt.config.{js,ts}",
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

