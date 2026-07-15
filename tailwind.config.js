/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./layout/**/*.php",
    "./pasien/**/*.php",
    "./dokter/**/*.php",
    "./obat/**/*.php",
    "./layanan/**/*.php",
    "./pemeriksaan/**/*.php",
    "./pembayaran/**/*.php",
    "./laporan/**/*.php",
    "./pengaturan/**/*.php"
  ],
  theme: {
    extend: {
      colors: {
        primary: '#0d9488',
        primaryHover: '#0f766e',
        secondary: '#10b981',
        slate: {
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#475569',
          700: '#334155',
          800: '#1e293b',
          900: '#0f172a',
        }
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
