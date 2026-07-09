<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Ambil data
$id          = intval($_POST['id_obat']);
$nama_obat   = htmlspecialchars($_POST['nama_obat']);
$jenis_obat  = htmlspecialchars($_POST['jenis_obat']);
$stok        = intval($_POST['stok']);
$harga       = intval($_POST['harga']);

// Prepared Statement
$stmt = mysqli_prepare(
    $koneksi,
    "UPDATE obat
     SET nama_obat=?,
         jenis_obat=?,
         stok=?,
         harga=?
     WHERE id_obat=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ssiii",
    $nama_obat,
    $jenis_obat,
    $stok,
    $harga,
    $id
);

// Eksekusi
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

<title>Update Data Obat</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data obat berhasil diperbarui.',

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

text:'Data obat gagal diperbarui.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.history.back();

});

</script>

<?php } ?>

</body>
</html>