<?php
include "../config/koneksi.php";

// Cek apakah ada ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// Prepared Statement
$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM pembayaran WHERE id_pembayaran=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

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

<title>Hapus Pembayaran</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pembayaran berhasil dihapus.',

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

text:'Data pembayaran gagal dihapus.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.location='index.php';

});

</script>

<?php } ?>

</body>

</html>