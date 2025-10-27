/** @type {import('tailwindcss').Config} */
export default {

  // ESTA ES LA LÍNEA QUE ARREGLA TU FONDO BLANCO
  corePlugins: {
    preflight: false,
  },
  // ----------------------------------------------

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}