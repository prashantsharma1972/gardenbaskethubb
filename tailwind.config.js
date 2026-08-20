/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./inc/**/*.php",
    "./public/**/*.{js,scss}"
  ],
  theme: {
    fontFamily: {
      sans: ["Roboto"],
      mulish: ["Mulish"],
    },
    extend: {},
  },
  plugins: [],
};
