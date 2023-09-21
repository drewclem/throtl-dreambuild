import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: "#fff3ed",
                    100: "#ffe5d4",
                    200: "#ffc6a8",
                    300: "#ff9e70",
                    400: "#ff6a37",
                    500: "#ff4310",
                    600: "#f02806",
                    700: "#c71907",
                    800: "#9e160e",
                    900: "#7f160f",
                    950: "#450605",
                },
            },
        },
    },

    plugins: [forms],
};
