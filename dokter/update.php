<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Ambil data
$id            = intval($_POST['id_dokter']);
$nama_dokter   = htmlspecialchars($_POST['nama_dokter']);
$spesialis     = htmlspecialchars($_POST['spesialis']);
$no_hp         = htmlspecialchars($_POST['no_hp']);
$alamat        = htmlspecialchars($_POST['alamat']);

// Prepared Statement
$stmt = mysqli_prepare(
    $koneksi,
    "UPDATE dokter
     SET nama_dokter=?,
         spesialis=?,
         no_hp=?,
         alamat=?
     WHERE id_dokter=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ssssi",
    $nama_dokter,
    $spesialis,
    $no_hp,
    $alamat,
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

<title>Update Dokter</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data dokter berhasil diperbarui.',

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

text:'Data dokter gagal diperbarui.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.history.back();

});

</script>

<?php } ?>

</body>
</html>