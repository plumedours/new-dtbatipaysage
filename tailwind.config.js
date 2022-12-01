/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{php,js}",
    "./node_modules/flowbite/**/*.js"
],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}