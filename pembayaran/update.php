<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Ambil data
$id                  = intval($_POST['id_pembayaran']);
$id_pemeriksaan      = intval($_POST['id_pemeriksaan']);
$total_bayar         = intval($_POST['total_bayar']);
$metode_pembayaran   = htmlspecialchars($_POST['metode_pembayaran']);
$tanggal_bayar       = $_POST['tanggal_bayar'];

// Prepared Statement
$stmt = mysqli_prepare(
    $koneksi,
    "UPDATE pembayaran
     SET
        id_pemeriksaan = ?,
        total_bayar = ?,
        metode_pembayaran = ?,
        tanggal_bayar = ?
     WHERE id_pembayaran = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "iissi",
    $id_pemeriksaan,
    $total_bayar,
    $metode_pembayaran,
    $tanggal_bayar,
    $id
);

// Eksekusi
if(mysqli_stmt_execute($stmt)){
    $status = "berhasil";
}else{
    $status = "gagal";
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Update Pembayaran</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pembayaran berhasil diperbarui.',

confirmButtonColor:'#198754'

}).then(()=>{

window.location='index.php';

});

</script>

<?php }else{ ?>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data pembayaran gagal diperbarui.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.history.back();

});

</script>

<?php } ?>

</body>
</html>