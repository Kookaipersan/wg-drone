/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./src/**/*.{html,js}", // ✅ pas de ./*.
    "./*.{html,js}", // ✅ ajoute la racine du projet aussi
  ],
  theme: {
    extend: {
      colors: {
        "brand-blue": "#134074",
        "brand-orange": "#ff6b00",
        "brand-orange-2": "#ffd580",
        "brand-green": "#eef4ed",
        "brand-grey": "#f7f9fa",
      },
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
      },
    },
  },
  plugins: [],
};
