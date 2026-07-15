# Klinik - Sistem Manajemen Klinik Yakusa V3

Sistem manajemen klinik modern yang terintegrasi untuk mengelola pasien, dokter, layanan, obat, pemeriksaan, dan pembayaran dalam satu aplikasi.

![Language](https://img.shields.io/badge/PHP-61.2%25-777BB4?style=flat-square)
![HTML](https://img.shields.io/badge/HTML-26.1%25-E34C26?style=flat-square)
![CSS](https://img.shields.io/badge/CSS-12%25-563D7C?style=flat-square)
![JavaScript](https://img.shields.io/badge/JavaScript-0.7%25-F7DF1E?style=flat-square)

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Struktur Direktori](#-struktur-direktori)
- [Instalasi](#-instalasi)
- [Penggunaan](#-penggunaan)
- [Modul Aplikasi](#-modul-aplikasi)
- [Database](#-database)
- [Panduan untuk Agent](#-panduan-untuk-agent)

## ✨ Fitur Utama

- **Dashboard Administrator**: Menampilkan ringkasan data dan statistik real-time
- **Manajemen Pasien**: Tambah, edit, hapus, dan lihat data pasien
- **Manajemen Dokter**: Kelola dokter dengan spesialisasi
- **Manajemen Layanan**: Atur layanan kesehatan dan harga
- **Manajemen Obat**: Pantau stok dan harga obat
- **Pemeriksaan Pasien**: Catat pemeriksaan pasien dengan diagnosis
- **Sistem Pembayaran**: Kelola transaksi pembayaran pasien
- **Laporan PDF**: Export data dalam format PDF
- **Interface Modern**: Desain responsif dengan Bootstrap dan Tailwind CSS
- **Grafik Statistik**: Visualisasi data dengan Chart.js

## 🛠 Teknologi

### Backend
- **PHP** - Server-side scripting (61.2%)
- **MySQL** - Database relasional
- **MySQLi** - PHP Database Interface

### Frontend
- **HTML** - Markup (26.1%)
- **CSS** - Styling (12%)
- **Tailwind CSS** - Utility-first CSS framework
- **Bootstrap** - Responsive UI components
- **JavaScript** - Client-side interactivity (0.7%)
- **Chart.js** - Data visualization
- **DataTables** - Interactive data tables
- **SweetAlert2** - Beautiful alert dialogs
- **Font Awesome** - Icon library

### Tools & Build
- **npm** - Package manager
- **Tailwind CLI** - CSS compilation

## 📁 Struktur Direktori

```
klinik/
├── index.php                 # Dashboard utama
├── config/
│   └── koneksi.php          # Konfigurasi koneksi database
├── layout/
│   ├── header.php           # Header template
│   ├── navbar.php           # Navigation bar
│   ├── sidebar.php          # Sidebar menu
│   └── footer.php           # Footer template
├── pasien/                  # Modul manajemen pasien
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── dokter/                  # Modul manajemen dokter
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── layanan/                 # Modul manajemen layanan
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── obat/                    # Modul manajemen obat
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── pemeriksaan/             # Modul pemeriksaan pasien
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── pembayaran/              # Modul manajemen pembayaran
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── laporan/                 # Modul laporan (PDF export)
│   ├── index.php
│   ├── cetak_pasien.php
│   ├── cetak_dokter.php
│   ├── cetak_obat.php
│   ├── cetak_pemeriksaan.php
│   └── cetak_pembayaran.php
├── pengaturan/              # Modul pengaturan sistem
├── profile/                 # Modul profil pengguna
├── assets/                  # Assets (CSS, JS, images)
├── fpdf/                    # Library untuk PDF generation
├── db_setup.sql             # Script setup database
├── package.json             # NPM dependencies
├── tailwind.config.js       # Tailwind CSS configuration
├── .gitignore               # Git ignore file
└── AGENTS.md                # Panduan untuk AI agents

```

## 🚀 Instalasi

### Persyaratan
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web Server (Apache, Nginx, dll)
- Node.js & npm (untuk build Tailwind CSS)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/suju0227/klinik.git
   cd klinik
   ```

2. **Setup Database**
   ```bash
   # Login ke MySQL
   mysql -u root -p
   
   # Buat database
   CREATE DATABASE db_klinik;
   
   # Import schema
   source db_setup.sql;
   ```

3. **Konfigurasi Koneksi Database**
   
   Edit `config/koneksi.php`:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "password_anda";
   $database = "db_klinik";
   ```

4. **Install Dependencies**
   ```bash
   npm install
   ```

5. **Build Tailwind CSS**
   ```bash
   npm run build
   ```

6. **Jalankan Aplikasi**
   ```bash
   # Menggunakan PHP built-in server
   php -S localhost:8000
   
   # Atau konfigurasi Virtual Host di web server Anda
   ```

   Akses aplikasi di: `http://localhost:8000`

## 📖 Penggunaan

### Dashboard
Halaman utama menampilkan:
- Total pasien, dokter, layanan, obat, pemeriksaan
- Statistik pendapatan (hari ini dan bulan ini)
- Grafik pemeriksaan bulanan
- Timeline aktivitas terbaru
- Quick menu akses cepat

### Navigasi Menu
Gunakan sidebar untuk mengakses modul-modul:
- **Pasien**: Kelola data pasien
- **Dokter**: Kelola data dokter dan spesialisasi
- **Layanan**: Atur layanan kesehatan
- **Obat**: Kelola stok obat
- **Pemeriksaan**: Catat pemeriksaan pasien
- **Pembayaran**: Kelola transaksi pembayaran
- **Laporan**: Export data dalam PDF

### Operasi CRUD
Setiap modul mendukung operasi:
- **Create (Tambah)**: Klik tombol "Tambah" untuk form input
- **Read (Lihat)**: Tampil dalam tabel dengan DataTables
- **Update (Edit)**: Klik tombol edit untuk mengubah data
- **Delete (Hapus)**: Klik tombol hapus dengan konfirmasi SweetAlert

## 📊 Modul Aplikasi

| Modul | Deskripsi | Fitur |
|-------|-----------|-------|
| **Pasien** | Manajemen data pasien | CRUD, pencarian, filter |
| **Dokter** | Manajemen dokter dan spesialisasi | CRUD, filter spesialis |
| **Layanan** | Manajemen layanan kesehatan | CRUD, harga, deskripsi |
| **Obat** | Manajemen inventori obat | CRUD, stok, harga |
| **Pemeriksaan** | Catat pemeriksaan pasien | CRUD, diagnosis, hubung ke dokter/pasien |
| **Pembayaran** | Kelola transaksi pembayaran | CRUD, metode bayar, laporan pendapatan |
| **Laporan** | Export data dalam PDF | Export pasien, dokter, obat, pemeriksaan, pembayaran |
| **Pengaturan** | Konfigurasi sistem | Update nama klinik, alamat, kontak |

## 🗄️ Database

### Struktur Tabel

**dokter**
- id_dokter (INT, PK)
- nama_dokter (VARCHAR)
- spesialis (VARCHAR)
- no_hp (VARCHAR)
- alamat (TEXT)

**pasien**
- id_pasien (INT, PK)
- nama_pasien (VARCHAR)
- jenis_kelamin (VARCHAR)
- umur (INT)
- alamat (TEXT)
- no_hp (VARCHAR)

**layanan**
- id_layanan (INT, PK)
- nama_layanan (VARCHAR)
- harga (INT)
- keterangan (TEXT)

**obat**
- id_obat (INT, PK)
- nama_obat (VARCHAR)
- jenis_obat (VARCHAR)
- stok (INT)
- harga (INT)

**pemeriksaan**
- id_pemeriksaan (INT, PK)
- id_pasien (INT, FK)
- id_dokter (INT, FK)
- tanggal_periksa (DATE)
- keluhan (TEXT)
- diagnosa (TEXT)

**detail_pemeriksaan**
- id_detail (INT, PK)
- id_pemeriksaan (INT, FK)
- id_layanan (INT, FK)
- jumlah (INT)

**pembayaran**
- id_pembayaran (INT, PK)
- id_pemeriksaan (INT, FK)
- total_bayar (INT)
- metode_pembayaran (VARCHAR)
- tanggal_bayar (DATE)

## 🤖 Panduan untuk Agent

Lihat [AGENTS.md](./AGENTS.md) untuk panduan lengkap tentang workflow development, best practices, dan guardrails proyek.

### Ringkasan Penting
- Mulai dengan **context discovery** sebelum membuat perubahan
- Gunakan **agent skills** yang sesuai untuk fase development
- Pertahankan konvensi **PHP/Bootstrap** yang sudah ada
- Jangan break **navigation links** (`/klinik/...`)
- Prioritaskan **repository facts** atas assumptions
- Buat changes yang **small, reviewable, dan aligned**

## 📝 Development Scripts

```bash
# Build Tailwind CSS (production)
npm run build

# Watch Tailwind CSS changes (development)
npm run watch
```

## 🔐 Security Notes

- Gunakan `htmlspecialchars()` untuk prevent XSS attacks
- Validasi semua input dari user
- Gunakan prepared statements untuk query database
- Implement proper access control untuk fitur sensitif

## 📞 Support

Untuk pertanyaan atau issues, silakan buat issue di repository ini.

## 📄 Lisensi

Proyek ini adalah fork dari [Ahmad200git/klinik](https://github.com/Ahmad200git/klinik).

---

**Last Updated**: 2026-07-15  
**Version**: 3.0.0
