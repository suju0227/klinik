-- Database Setup untuk Klinik Yakusa

USE db_klinik;

-- 1. Tabel Dokter
CREATE TABLE IF NOT EXISTS dokter (
    id_dokter INT AUTO_INCREMENT PRIMARY KEY,
    nama_dokter VARCHAR(100) NOT NULL,
    spesialis VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel Pasien
CREATE TABLE IF NOT EXISTS pasien (
    id_pasien INT AUTO_INCREMENT PRIMARY KEY,
    nama_pasien VARCHAR(100) NOT NULL,
    jenis_kelamin VARCHAR(20) NOT NULL,
    umur INT NOT NULL,
    alamat TEXT NOT NULL,
    no_hp VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Obat
CREATE TABLE IF NOT EXISTS obat (
    id_obat INT AUTO_INCREMENT PRIMARY KEY,
    nama_obat VARCHAR(100) NOT NULL,
    jenis_obat VARCHAR(100) NOT NULL,
    stok INT NOT NULL,
    harga INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Layanan
CREATE TABLE IF NOT EXISTS layanan (
    id_layanan INT AUTO_INCREMENT PRIMARY KEY,
    nama_layanan VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    keterangan TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabel Pemeriksaan
CREATE TABLE IF NOT EXISTS pemeriksaan (
    id_pemeriksaan INT AUTO_INCREMENT PRIMARY KEY,
    id_pasien INT NOT NULL,
    id_dokter INT NOT NULL,
    tanggal_periksa DATE NOT NULL,
    keluhan TEXT,
    diagnosa TEXT,
    FOREIGN KEY (id_pasien) REFERENCES pasien(id_pasien) ON DELETE CASCADE,
    FOREIGN KEY (id_dokter) REFERENCES dokter(id_dokter) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Tabel Detail Pemeriksaan
CREATE TABLE IF NOT EXISTS detail_pemeriksaan (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_pemeriksaan INT NOT NULL,
    id_layanan INT NOT NULL,
    jumlah INT DEFAULT 1,
    FOREIGN KEY (id_pemeriksaan) REFERENCES pemeriksaan(id_pemeriksaan) ON DELETE CASCADE,
    FOREIGN KEY (id_layanan) REFERENCES layanan(id_layanan) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Tabel Pembayaran
CREATE TABLE IF NOT EXISTS pembayaran (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
    id_pemeriksaan INT NOT NULL,
    total_bayar INT NOT NULL,
    metode_pembayaran VARCHAR(50) NOT NULL,
    tanggal_bayar DATE NOT NULL,
    FOREIGN KEY (id_pemeriksaan) REFERENCES pemeriksaan(id_pemeriksaan) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- INSERT DATA AWAL (MOCK DATA)
INSERT INTO dokter (nama_dokter, spesialis, no_hp, alamat) VALUES
('Dr. Ahmad Fauzi', 'Spesialis Anak', '08123456789', 'Jl. Sudirman No. 10'),
('Dr. Siti Aminah', 'Dokter Umum', '08129876543', 'Jl. Gatot Subroto No. 25'),
('Dr. Budi Hermawan', 'Spesialis Gigi', '08567890123', 'Jl. Merdeka No. 5');

INSERT INTO pasien (nama_pasien, jenis_kelamin, umur, alamat, no_hp) VALUES
('Andi Wijaya', 'Laki-laki', 28, 'Jl. Mawar No. 3', '08987654321'),
('Dewi Lestari', 'Perempuan', 35, 'Jl. Melati No. 12', '08781234567'),
('Rizky Ramadhan', 'Laki-laki', 12, 'Jl. Dahlia No. 45', '08213456789');

INSERT INTO obat (nama_obat, jenis_obat, stok, harga) VALUES
('Paracetamol 500mg', 'Tablet', 150, 5000),
('Amoxicillin 500mg', 'Kapsul', 100, 10000),
('OBH Syrup 100ml', 'Sirup', 50, 15000);

INSERT INTO layanan (nama_layanan, harga, keterangan) VALUES
('Konsultasi Dokter Umum', 50000, 'Konsultasi kesehatan umum oleh dokter jaga'),
('Pembersihan Karang Gigi', 150000, 'Pembersihan karang gigi atas dan bawah'),
('Pemeriksaan Anak Spesialis', 100000, 'Pemeriksaan kesehatan anak rutin');
