<?php
// ==========================================
// Koneksi Database
// Sistem Manajemen Database Klinik
// ==========================================

$host     = "localhost";
$username = "root";
$password = "";
$database = "db_klinik";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi database gagal : " . mysqli_connect_error());
}

// Mengatur timezone Indonesia
date_default_timezone_set('Asia/Makassar');

// Membaca pengaturan klinik
$settings_file_path = __DIR__ . '/settings.json';
if (file_exists($settings_file_path)) {
    $settings = json_decode(file_get_contents($settings_file_path), true);
} else {
    $settings = [
        'nama_klinik' => 'Klinik Yakusa',
        'alamat' => 'Jl. Imam Inlu Amal No.1947',
        'telepon' => '0856-5619-1731',
        'email' => 'info@klinikyakusa.com',
        'jam_buka' => '08:00',
        'jam_tutup' => '21:00'
    ];
}
?>