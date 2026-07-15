# Spesifikasi Desain: Kompilasi Tailwind CSS Lokal (Klinik Yakusa)

## Pendahuluan
Dokumen ini merancang penggantian Tailwind CSS Play CDN (`https://cdn.tailwindcss.com`) dengan Tailwind CSS terkompilasi lokal. Hal ini dilakukan untuk menghilangkan peringatan konsol mengenai penggunaan CDN di lingkungan produksi serta meningkatkan performa pemuatan halaman.

## Analisis Masalah
1. File [layout/header.php](file:///c:/xampp/htdocs/klinik/layout/header.php) saat ini memuat `https://cdn.tailwindcss.com` sebagai tag script.
2. Browser memunculkan peringatan: `cdn.tailwindcss.com should not be used in production...` karena pemrosesan utility classes runtime memakan memori, tidak dioptimalkan (no tree-shaking), dan dapat memicu Flash of Unstyled Content (FOUC).
3. Untuk menghilangkannya, kita perlu memproses kelas Tailwind secara lokal dan hanya menyertakan CSS yang benar-benar digunakan.

## Rencana Perubahan

### 1. Inisialisasi Project Node (`package.json`)
Buat berkas [package.json](file:///c:/xampp/htdocs/klinik/package.json) dengan isi berikut:
```json
{
  "name": "klinik-insan-cita",
  "version": "3.0.0",
  "private": true,
  "scripts": {
    "build": "npx tailwindcss -i ./assets/css/tailwind-input.css -o ./assets/css/tailwind.css --minify",
    "watch": "npx tailwindcss -i ./assets/css/tailwind-input.css -o ./assets/css/tailwind.css --watch"
  },
  "devDependencies": {
    "tailwindcss": "^3.4.1"
  }
}
```

### 2. Konfigurasi Tailwind (`tailwind.config.js`)
Buat berkas [tailwind.config.js](file:///c:/xampp/htdocs/klinik/tailwind.config.js) dengan isi berikut:
```javascript
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
```

### 3. CSS Input (`assets/css/tailwind-input.css`)
Buat berkas [assets/css/tailwind-input.css](file:///c:/xampp/htdocs/klinik/assets/css/tailwind-input.css):
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### 4. Perubahan Berkas Template (`layout/header.php`)
Ubah berkas [layout/header.php](file:///c:/xampp/htdocs/klinik/layout/header.php#L53-L82) dengan diff berikut:
```diff
-<!-- Tailwind CSS Play CDN -->
-<script src="https://cdn.tailwindcss.com"></script>
-<script>
-  tailwind.config = {
-    theme: {
-      extend: {
-        colors: {
-          primary: '#0d9488',
-          primaryHover: '#0f766e',
-          secondary: '#10b981',
-          slate: {
-            50: '#f8fafc',
-            100: '#f1f5f9',
-            200: '#e2e8f0',
-            300: '#cbd5e1',
-            400: '#94a3b8',
-            500: '#64748b',
-            600: '#475569',
-            700: '#334155',
-            800: '#1e293b',
-            900: '#0f172a',
-          }
-        },
-        fontFamily: {
-          sans: ['Poppins', 'sans-serif'],
-        }
-      }
-    }
-  }
-</script>
+<link rel="stylesheet" href="<?= $basePath ?>assets/css/tailwind.css">
```

## Rencana Verifikasi
1. **Pemasangan Dependensi**:
   - Jalankan `npm install`. Verifikasi `node_modules` terbuat.
2. **Kompilasi Sukses**:
   - Jalankan `npm run build`. Verifikasi berkas `assets/css/tailwind.css` terbuat dan terkompresi.
3. **Pengecekan Konsol Browser**:
   - Buka aplikasi klinik di browser. Pastikan peringatan `cdn.tailwindcss.com should not be used in production` tidak lagi muncul di tab konsol.
4. **Verifikasi Visual**:
   - Pastikan layout aplikasi klinik tetap utuh, rapi, dan skema warna kustom (`bg-primary`, dll.) bekerja normal.
