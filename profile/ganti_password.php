<?php
// ============================================================
// GANTI PASSWORD - PROCESSOR
// Karena sistem ini tidak punya tabel users/admin,
// password disimpan ke settings.json dengan hash password_hash()
// ============================================================
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$password_lama      = trim($_POST['password_lama'] ?? '');
$password_baru      = trim($_POST['password_baru'] ?? '');
$password_konfirmasi = trim($_POST['password_konfirmasi'] ?? '');

// Validasi
if (empty($password_lama) || empty($password_baru) || empty($password_konfirmasi)) {
    header("Location: index.php?status=kosong");
    exit;
}

if (strlen($password_baru) < 6) {
    header("Location: index.php?status=terlalu_pendek");
    exit;
}

if ($password_baru !== $password_konfirmasi) {
    header("Location: index.php?status=tidak_cocok");
    exit;
}

// Cek password lama dari settings
$password_hash_file = __DIR__ . '/../config/admin_password.php';
$default_password   = 'admin123'; // Password default

if (file_exists($password_hash_file)) {
    $stored_hash = trim(file_get_contents($password_hash_file));
    $valid = password_verify($password_lama, $stored_hash);
} else {
    // Jika belum ada file password, bandingkan dengan default
    $valid = ($password_lama === $default_password);
}

if (!$valid) {
    header("Location: index.php?status=salah_lama");
    exit;
}

// Simpan password baru
$new_hash = password_hash($password_baru, PASSWORD_DEFAULT);
if (file_put_contents($password_hash_file, $new_hash) === false) {
    header("Location: index.php?status=gagal");
    exit;
}

header("Location: index.php?status=berhasil");
exit;
