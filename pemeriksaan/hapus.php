<?php
include "../config/koneksi.php";

if(!isset($_GET['id'])){
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM pemeriksaan WHERE id_pemeriksaan=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

if(mysqli_stmt_execute($stmt)){
    $status="berhasil";
}else{
    $status="gagal";
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Hapus Pemeriksaan</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pemeriksaan berhasil dihapus.',

confirmButtonColor:'#0dcaf0'

}).then(()=>{

window.location='index.php';

});

</script>

<?php }else{ ?>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data pemeriksaan gagal dihapus.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.location='index.php';

});

</script>

<?php } ?>

</body>
</html>