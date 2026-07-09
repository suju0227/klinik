<?php
include "../config/koneksi.php";

// Pastikan ID tersedia
if (!isset($_GET['id'])) {
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

// Prepared Statement
$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM pasien WHERE id_pasien=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    $status = "berhasil";
} else {
    $status = "gagal";
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Hapus Pasien</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pasien berhasil dihapus.',

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

text:'Data pasien gagal dihapus.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.location='index.php';

});

</script>

<?php } ?>

</body>

</html>