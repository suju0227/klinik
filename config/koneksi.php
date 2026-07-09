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
?>