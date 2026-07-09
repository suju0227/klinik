<?php
include "../config/koneksi.php";

// Cek apakah id_pemeriksaan dikirim
if (!isset($_GET['id_pemeriksaan'])) {
    echo json_encode([
        "layanan" => [],
        "total" => 0
    ]);
    exit;
}

$id_pemeriksaan = intval($_GET['id_pemeriksaan']);

// Ambil semua layanan dari pemeriksaan yang dipilih
$query = mysqli_query($koneksi, "
SELECT
    layanan.id_layanan,
    layanan.nama_layanan,
    layanan.harga,
    detail_pemeriksaan.jumlah
FROM detail_pemeriksaan

INNER JOIN layanan
ON detail_pemeriksaan.id_layanan = layanan.id_layanan

WHERE detail_pemeriksaan.id_pemeriksaan = '$id_pemeriksaan'
");

$data = [];
$total = 0;

while ($row = mysqli_fetch_assoc($query)) {

    $subtotal = $row['harga'] * $row['jumlah'];

    $total += $subtotal;

    $data[] = [
        "id_layanan"   => $row['id_layanan'],
        "nama_layanan" => $row['nama_layanan'],
        "harga"        => (int)$row['harga'],
        "jumlah"       => (int)$row['jumlah'],
        "subtotal"     => (int)$subtotal
    ];
}

// Kirim ke Javascript dalam format JSON
echo json_encode([
    "layanan" => $data,
    "total"   => $total
]);
?>