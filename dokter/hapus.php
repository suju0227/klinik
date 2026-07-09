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
    "DELETE FROM dokter WHERE id_dokter=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

// Eksekusi
if(mysqli_stmt_execute($stmt)){
    $status="berhasil";
}else{
    $status="gagal";
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Hapus Dokter</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data dokter berhasil dihapus.',

confirmButtonColor:'#16a34a'

}).then(()=>{

window.location='index.php';

});

</script>

<?php }else{ ?>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data dokter gagal dihapus.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.location='index.php';

});

</script>

<?php } ?>

</body>

</html>