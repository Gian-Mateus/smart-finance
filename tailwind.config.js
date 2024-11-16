/** @type {import('tailwindcss').Config} */
export default {
  content: [
		"./resources/**/*.blade.php",
		 "./resources/**/*.js",
		 "./resources/**/*.vue",
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
    ],
    daisyui: {
        themes: ["coffee"],
    },
  theme: {
    extend: {
      fontFamily: {
        sans: ['Open Sans', 'sans-serif'],
      }
    },
  },
  plugins: [
		require("daisyui")
	],
}

