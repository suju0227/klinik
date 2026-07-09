<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Ambil data dari form
$nama_obat  = htmlspecialchars($_POST['nama_obat']);
$jenis_obat = htmlspecialchars($_POST['jenis_obat']);
$stok       = intval($_POST['stok']);
$harga      = intval($_POST['harga']);

// Prepared Statement
$stmt = mysqli_prepare(
    $koneksi,
    "INSERT INTO obat (nama_obat, jenis_obat, stok, harga)
     VALUES (?, ?, ?, ?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "ssii",
    $nama_obat,
    $jenis_obat,
    $stok,
    $harga
);

// Eksekusi
if (mysqli_stmt_execute($stmt)) {
    $status = "berhasil";
} else {
    $status = "gagal";
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Simpan Data Obat</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data obat berhasil disimpan.',

confirmButtonColor:'#f59e0b'

}).then(()=>{

window.location='index.php';

});

</script>

<?php }else{ ?>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data obat gagal disimpan.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.history.back();

});

</script>

<?php } ?>

</body>

</html>