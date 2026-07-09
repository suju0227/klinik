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

// ==========================================
// PENGATURAN KLINIK GLOBAL
// ==========================================

$default_settings = [
    'nama_klinik' => 'Klinik Yakusa',
    'alamat' => 'Jl. Imam Inlu Amal No.1947',
    'telepon' => '0856-5619-1731',
    'email' => 'info@klinikyakusa.com',
    'jam_buka' => '08:00',
    'jam_tutup' => '21:00'
];

$settings_file_path = __DIR__ . '/settings.json';
if (file_exists($settings_file_path)) {
    $loaded_settings = json_decode(file_get_contents($settings_file_path), true);
    if (is_array($loaded_settings)) {
        $settings = array_merge($default_settings, $loaded_settings);
    } else {
        $settings = $default_settings;
    }
} else {
    $settings = $default_settings;
}
?>