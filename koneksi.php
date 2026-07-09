<?php

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_klinik"
);

if (!$koneksi) {
    die("Koneksi gagal");
}

// Membaca pengaturan klinik
$settings_file_path = __DIR__ . '/config/settings.json';
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