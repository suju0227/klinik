# Spesifikasi Desain: Redesain Dashboard Klinik Yakusa (Hitam Hijau Melayang)

## Pendahuluan
Dokumen ini merancang redesain visual antarmuka sistem Klinik Yakusa V3. Konsep yang diusung adalah **Dark-Green Glassmorphism** dengan struktur **Floating Card** (melayang). Tujuannya adalah menghadirkan antarmuka sistem yang modern, premium, dan profesional dengan dominasi warna hitam pekat dan aksen pendaran hijau neon.

## Spesifikasi Token Desain & Tema Gelap (`assets/css/style.css`)
*   **Latar Belakang (`body`)**: Diubah menjadi gelap pekat:
    ```css
    body {
        background: linear-gradient(180deg, #020617 0%, #090f1d 100%);
        color: #f1f5f9;
        min-height: 100vh;
    }
    ```
*   **Variabel CSS Baru (`:root`)**:
    - `--slate-900`: `#0f172a`
    - `--slate-950`: `#020617`
    - `--primary`: `#10b981` (Hijau Emerald)
    - `--primary-hover`: `#34d399` (Hijau Mint Terang)
    - `--surface-glass`: `rgba(10, 15, 30, 0.65)`
    - `--border-glass`: `rgba(16, 185, 129, 0.12)`
    - `--border-glass-hover`: `rgba(16, 185, 129, 0.28)`
    - `--shadow-glass`: `0 20px 40px rgba(2, 6, 23, 0.3)`
    - `--shadow-glow`: `0 0 15px rgba(16, 185, 129, 0.2)`
*   **Kelas Kartu Kaca Gelap (`.card-glass`)**:
    ```css
    .card-glass {
        background: var(--surface-glass) !important;
        backdrop-filter: blur(22px) !important;
        -webkit-backdrop-filter: blur(22px) !important;
        border: 1px solid var(--border-glass) !important;
        border-radius: 20px !important;
        box-shadow: var(--shadow-glass) !important;
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease !important;
    }
    .card-glass:hover {
        transform: translateY(-5px);
        border-color: var(--border-glass-hover) !important;
        box-shadow: var(--shadow-glass), var(--shadow-glow) !important;
    }
    ```

## Spesifikasi Layout Melayang

### 1. Sidebar Melayang (`assets/css/sidebar.css`)
*   **Layout Baru**:
    - `width: 280px; position: fixed; left: 0; top: 0; margin: 20px; height: calc(100vh - 40px);`
    - Latar belakang menggunakan `.card-glass` dengan pembatas kiri-kanan bersih.
*   **Menu & Interaksi**:
    - Item menu memiliki transisi geser saat hover (`transform: translateX(4px)`).
    - Item menu aktif (`.active`) menggunakan warna latar belakang hijau transparan berpendar (`rgba(16, 185, 129, 0.1)`) dengan indikator garis sisi hijau neon menyala.

### 2. Topbar Melayang (`assets/css/navbar.css`)
*   **Layout Baru**:
    - `position: sticky; top: 20px; margin-bottom: 24px; border-radius: 20px;`
    - Menggunakan latar belakang `.card-glass` dengan tinggi dan padding yang seimbang.
*   **Elemen Interaktif**:
    - Kotak pencarian (`.search-wrapper`), kotak waktu/tanggal (`.datetime-box`), tombol notifikasi, dan tombol profil menggunakan styling glass gelap.

### 3. Penyesuaian Area Utama (`assets/css/style.css` & `assets/css/sidebar.css`)
*   **Desktop Layout**:
    - `.main` diatur agar memiliki `margin-left: 320px; padding: 24px 24px 24px 0;` (memberikan ruang untuk sidebar melayang di sebelah kiri).
*   **Mobile Layout (< 992px)**:
    - `.main` diatur memiliki `margin-left: 0; padding: 16px;`.
    - Sidebar tersembunyi dengan posisi awal `left: -320px` dan meluncur ke depan sebagai panel melayang.

### 4. Konten Dashboard (`assets/css/dashboard.css`)
*   **Hero Dashboard**:
    - Diubah dari gradasi teal-blue menjadi gradasi hitam-gelap-hijau: `linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(2, 6, 23, 0.85))`.
    - Batas tipis warna hijau transparan dengan bayangan berpendar hijau neon lembut.
    - Jam digital dengan warna teks `#10b981` dan efek pendar teks (`text-shadow: 0 0 10px rgba(16, 185, 129, 0.4)`).
*   **Kartu Statistik & Grid**:
    - Seluruh kartu data (`pasien`, `dokter`, `layanan`, dsb.) dibungkus menggunakan `.card-glass` dan memiliki efek hover glow hijau.

## Rencana Verifikasi
1. **Verifikasi Desktop**:
   - Memastikan sidebar melayang di sebelah kiri dengan margin yang pas dari tepi atas, bawah, dan kiri layar.
   - Memastikan navbar melayang di atas konten utama sejajar dengan batas kanan konten.
   - Memastikan seluruh konten dashboard ter-render dengan warna latar belakang hitam pekat dan komponen glassmorphism gelap.
2. **Verifikasi Hover & Transisi**:
   - Memastikan kartu statistik terangkat sedikit dan bercahaya hijau saat kursor diarahkan ke kartu tersebut.
   - Memastikan menu sidebar bergeser ke kanan saat di-hover dan memicu transisi warna.
3. **Verifikasi Responsivitas**:
   - Memeriksa tampilan mobile di Chrome DevTools, memastikan sidebar disembunyikan dengan benar dan muncul melayang ketika tombol menu diklik tanpa merusak layout konten utama.
