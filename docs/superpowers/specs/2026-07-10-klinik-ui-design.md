# Rencana Desain Konsistensi Visual (Pendekatan C - Hybrid)

## Pendahuluan
Dokumen desain ini menjelaskan rencana standardisasi tata letak (layout) dan desain visual antarmuka sistem Klinik Yakusa V3. Tujuannya adalah menyatukan halaman yang sebelumnya terpisah (outlier) serta menyelaraskan skema warna di seluruh halaman modul utama (CRUD) agar terasa kohesif, modern, dan profesional menggunakan identitas hijau klinik dengan sentuhan kartu kaca (*glassmorphism*).

## Spesifikasi Desain

### 1. Struktur Tata Letak Utama (Layout Integration)
Halaman tambah dan edit pasien ([pasien/tambah.php](file:///c:/xampp/htdocs/klinik/pasien/tambah.php) dan [pasien/edit.php](file:///c:/xampp/htdocs/klinik/pasien/edit.php)) akan diubah agar menggunakan file master layout yang sama dengan modul lainnya:
```php
<?php
include "../config/koneksi.php";
include "../layout/header.php";
?>
<div class="wrapper">
    <?php include "../layout/sidebar.php"; ?>
    <div class="main">
        <?php include "../layout/navbar.php"; ?>
        <div class="container-fluid py-4">
            <!-- Konten Halaman -->
        </div>
    </div>
</div>
<?php include "../layout/footer.php"; ?>
```

### 2. Aksen Kartu Kaca (Glass Card)
Kita menambahkan kelas CSS kustom `.card-glass` pada [assets/css/style.css](file:///c:/xampp/htdocs/klinik/assets/css/style.css):
```css
.card-glass {
    background: rgba(255, 255, 255, 0.55) !important;
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    border-radius: 24px !important;
    box-shadow: 0 10px 30px 0 rgba(15, 23, 42, 0.04) !important;
}
```
Seluruh formulir tambah dan edit (`pasien`, `dokter`, `obat`, `layanan`, `pemeriksaan`, `pembayaran`) akan dibungkus dengan kartu kelas `.card-glass` ini.

### 3. Penyeragaman Skema Warna (Brand Identity)
Setiap halaman utama modul (indeks) diseragamkan menggunakan skema warna **Hijau Klinik** (`bg-success` dan kelas tabel `table-success`), menggantikan warna variatif (biru, kuning, merah, dll.) yang sebelumnya terfragmentasi:
*   [pasien/index.php](file:///c:/xampp/htdocs/klinik/pasien/index.php) -> Ubah ke `bg-success` / `table-success`
*   [dokter/index.php](file:///c:/xampp/htdocs/klinik/dokter/index.php) -> Tetap `bg-success` / `table-success`
*   [obat/index.php](file:///c:/xampp/htdocs/klinik/obat/index.php) -> Ubah ke `bg-success` / `table-success`
*   [layanan/index.php](file:///c:/xampp/htdocs/klinik/layanan/index.php) -> Ubah ke `bg-success` / `table-success`
*   [pemeriksaan/index.php](file:///c:/xampp/htdocs/klinik/pemeriksaan/index.php) -> Ubah ke `bg-success` / `table-success`
*   [pembayaran/index.php](file:///c:/xampp/htdocs/klinik/pembayaran/index.php) -> Ubah ke `bg-success` / `table-success`
*   [laporan/index.php](file:///c:/xampp/htdocs/klinik/laporan/index.php) -> Menyesuaikan kartu menu laporan.

### 4. Standardisasi Tombol Aksi
*   Tombol "Tambah Data" pada setiap halaman indeks akan diseragamkan menggunakan kelas Bootstrap `btn-success` atau `btn-dark`.
*   Tombol "Kembali" pada halaman form menggunakan `btn-secondary` atau `btn-outline-secondary`.
