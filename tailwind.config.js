/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/**/*.blade.php",
        "./resources/**/**/*.js",
        "./app/View/Components/**/**/*.php",
        "./app/Livewire/**/**/*.php",

        // Add mary
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",

        // Laravel Pagination
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    daisyui: {
        theme: ["cupcake"]
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito'],
            },
        },
    },
    plugins: [
		require("daisyui")
	],
};
