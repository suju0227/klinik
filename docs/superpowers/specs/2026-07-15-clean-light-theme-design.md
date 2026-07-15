# Spesifikasi Desain: Redesain Dashboard Klinik Yakusa (Clean Light Mode - Teal Slate)

## Pendahuluan
Dokumen ini merancang redesain visual antarmuka sistem Klinik Yakusa V3. Konsep yang diusung adalah **Clean Light Mode** dengan dominasi warna putih bersih, abu-abu Slate yang sejuk, dan aksen Teal Medis profesional. Tujuannya adalah menghadirkan antarmuka sistem yang modern, sangat profesional, bersih, dan nyaman dipandang oleh staf klinik dalam jangka waktu lama.

## Spesifikasi Token Desain & Tema Terang (`assets/css/style.css`)
*   **Latar Belakang (`body`)**: Diubah menjadi terang dan sejuk:
    ```css
    body {
        background: #f8fafc; /* Slate 50 */
        color: #1e293b;      /* Slate 800 */
        min-height: 100vh;
    }
    ```
*   **Variabel CSS Baru (`:root`)**:
    - `--primary`: `#0d9488` (Teal 600)
    - `--primary-hover`: `#0f766e` (Teal 700)
    - `--secondary`: `#0ea5e9` (Sky 500)
    - `--secondary-hover`: `#0284c7` (Sky 600)
    - `--surface`: `#ffffff` (Solid Putih Bersih)
    - `--border-subtle`: `#f1f5f9` (Slate 100)
    - `--border-strong`: `#e2e8f0` (Slate 200)
    - `--text-strong`: `#0f172a` (Slate 900)
    - `--text-default`: `#334155` (Slate 700)
    - `--text-muted`: `#64748b` (Slate 500)
    - `--shadow-soft`: `0 2px 12px rgba(15, 23, 42, 0.04)`
    - `--shadow-hover`: `0 8px 24px rgba(15, 23, 42, 0.08)`
*   **Pembaruan Kartu Kaca (`.card-glass`)**:
    Diubah menjadi kartu solid terang yang modern:
    ```css
    .card-glass {
        background: var(--surface) !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
        border: 1px solid var(--border-strong) !important;
        border-radius: var(--radius-xl) !important;
        box-shadow: var(--shadow-soft) !important;
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease !important;
    }
    .card-glass:hover {
        transform: translateY(-5px);
        border-color: var(--primary) !important;
        box-shadow: var(--shadow-hover) !important;
    }
    ```

## Spesifikasi Layout Terang

### 1. Sidebar Bersih (`assets/css/sidebar.css`)
*   **Struktur Visual**:
    - Menggunakan warna latar solid putih (`var(--surface)`) dengan border pembatas sisi kanan menggunakan abu-abu halus (`var(--border-strong)`).
    - Teks sidebar diubah menjadi gelap (`var(--text-default)`).
*   **Menu & Interaksi**:
    - Item menu aktif (`.active`) menggunakan warna latar teal sangat tipis (`rgba(13, 148, 136, 0.08)`) dengan teks Teal Medis (`#0d9488`) dan garis indikator sisi kanan berwarna teal solid.
    - Item menu hover menggunakan warna latar `rgba(13, 148, 136, 0.04)` dengan teks berubah menjadi Teal Medis (`#0d9488`).
    - Kartu profil Administrator menggunakan latar belakang terang sejuk (`#f8fafc`) dengan border tipis dan nama administrator berwarna gelap.

### 2. Topbar Bersih (`assets/css/navbar.css`)
*   **Struktur Visual**:
    - Latar belakang putih solid (`var(--surface)`) dengan border tipis keliling (`var(--border-strong)`) dan bayangan halus (`var(--shadow-soft)`).
*   **Elemen Interaktif**:
    - Kotak pencarian (`.search-wrapper`), waktu/tanggal (`.datetime-box`), tombol notifikasi, dan tombol profil diubah menggunakan latar belakang abu-abu sangat muda (`#f8fafc`) dengan teks gelap.
    - Ikon dan efek hover diubah ke skema Teal Medis.

### 3. Konten Dashboard (`assets/css/dashboard.css`)
*   **Hero Dashboard**:
    - Diubah menjadi gradasi Teal Medis Premium: `linear-gradient(135deg, #0d9488 0%, #0f766e 100%)`.
    - Ikon info dan jam digital tetap menggunakan warna kontras terang (putih/mint) untuk kenyamanan baca.
*   **Kartu Statistik**:
    - Menggunakan gradasi warna solid yang cerah dan profesional (Teal, Blue, Indigo, Orange).
    - Menghilangkan efek pendaran glow hijau neon pada hover, digantikan dengan elevation shadow halus.

## Sinkronisasi Tailwind CSS (`tailwind.config.js`)
*   Memastikan warna-warna kustom seperti `primary`, `secondary`, dan skala `slate` sinkron dengan warna terang medis baru agar saat proses kompilasi `npm run build` berjalan, output CSS terkompilasi sejalan dengan tema baru.

## Rencana Verifikasi
1. **Verifikasi Tampilan Terang**:
   - Memastikan seluruh latar belakang berwarna abu-abu terang sejuk dan teks terlihat kontras.
   - Memastikan tidak ada sisa-sisa elemen gelap transparan (glassmorphism gelap) yang mengaburkan teks.
2. **Verifikasi Hover & Transisi**:
   - Memastikan menu sidebar, kartu statistik, dan tombol navigasi di topbar memiliki transisi hover yang halus dan warna yang sesuai.
3. **Verifikasi Responsivitas**:
   - Memastikan layout tetap utuh di lebar desktop maupun mobile saat sidebar dibuka/ditutup.
