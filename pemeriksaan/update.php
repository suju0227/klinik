<?php
include "../config/koneksi.php";

// Cek request
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location:index.php");
    exit;
}

// Ambil data
$id                 = intval($_POST['id_pemeriksaan']);
$id_pasien          = intval($_POST['id_pasien']);
$id_dokter          = intval($_POST['id_dokter']);
$tanggal_periksa    = $_POST['tanggal_periksa'];
$keluhan            = htmlspecialchars($_POST['keluhan']);
$diagnosa           = htmlspecialchars($_POST['diagnosa']);

// Prepared Statement
$stmt = mysqli_prepare(
    $koneksi,
    "UPDATE pemeriksaan
    SET
    id_pasien=?,
    id_dokter=?,
    tanggal_periksa=?,
    keluhan=?,
    diagnosa=?
    WHERE id_pemeriksaan=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "iisssi",
    $id_pasien,
    $id_dokter,
    $tanggal_periksa,
    $keluhan,
    $diagnosa,
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

<title>Update Pemeriksaan</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pemeriksaan berhasil diperbarui.',

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

text:'Data pemeriksaan gagal diperbarui.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.history.back();

});

</script>

<?php } ?>

</body>
</html>