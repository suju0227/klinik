# Spesifikasi Desain: Perbaikan Layout Lebar Desktop (Klinik Yakusa)

## Pendahuluan
Dokumen ini merancang perbaikan masalah tata letak (layout) pada Klinik Yakusa V3 di mana lebar halaman utama (`.main`) melebihi batas kanan layar desktop (viewport overflow). Hal ini mengakibatkan konten di sisi kanan, seperti menu dropdown profil administrator di navbar, terpotong.

## Analisis Masalah
1. Kelas `.wrapper` dikonfigurasi sebagai `display: flex; width: 100%;` di dalam `assets/css/style.css`.
2. Kelas `.sidebar` menggunakan `position: fixed; width: 280px;`, membuatnya berada di luar alur dokumen normal (*out-of-flow*).
3. Karena `.sidebar` berada di luar alur flex, kelas `.main` (sebagai satu-satunya elemen flex aktif) mengambil lebar penuh `100%` dari kontainer `.wrapper`.
4. Dengan tambahan margin kiri `margin-left: 280px` (atau `margin-left: 92px` saat sidebar ciut), lebar visual `.main` menjadi `100% + 280px` (atau `100% + 92px`), mendorong 280px (atau 92px) konten ke sebelah kanan layar di mana dia dipotong oleh `body { overflow-x: hidden; }`.

## Rencana Perubahan

### CSS (`assets/css/style.css`)
Mengubah layout `.wrapper` menjadi `display: block`. Sebagai elemen blok standar dengan `width: 100%` (atau `auto`), elemen `.main` akan secara otomatis menyesuaikan lebarnya sendiri (`100% - margin-left`) sesuai dengan margin sisi kiri yang diterapkan, tanpa terjadi overflow.

Properti `flex: 1` pada `.main` juga akan dihapus untuk menjaga kebersihan kode.

#### Detail Perubahan Ddiff:
```diff
--- a/assets/css/style.css
+++ b/assets/css/style.css
@@ -121,3 +121,3 @@
 .wrapper{
-    display:flex;
+    display:block;
     width:100%;
@@ -131,3 +131,2 @@
 .main{
-    flex:1;
     margin-left:280px;
```

## Rencana Verifikasi
1. **Verifikasi Visual**:
   - Memastikan tidak ada bagian kanan dari navbar (terutama profil administrator) yang terpotong pada lebar layar desktop (> 992px).
   - Memastikan seluruh konten utama masuk di dalam area viewport dan tidak ada overflow horizontal tersembunyi.
2. **Verifikasi Responsif & Sidebar Toggle**:
   - Memastikan saat sidebar diciutkan (collapsed), lebar `.main` membesar dengan mulus menyesuaikan margin kiri baru (`92px`).
   - Memastikan pada ukuran mobile (< 992px), `.main` memiliki `margin-left: 0` dan lebar penuh `100%`.
