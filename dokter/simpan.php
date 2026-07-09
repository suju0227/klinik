<?php
include "../config/koneksi.php";

// Mengambil data dari form
$nama_dokter = htmlspecialchars($_POST['nama_dokter']);
$spesialis   = htmlspecialchars($_POST['spesialis']);
$no_hp       = htmlspecialchars($_POST['no_hp']);
$alamat      = htmlspecialchars($_POST['alamat']);

// Prepared Statement
$stmt = mysqli_prepare($koneksi, "INSERT INTO dokter (nama_dokter, spesialis, no_hp, alamat) VALUES (?, ?, ?, ?)");

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $nama_dokter,
    $spesialis,
    $no_hp,
    $alamat
);

// Eksekusi
if (mysqli_stmt_execute($stmt)) {

?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Berhasil</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data dokter berhasil disimpan.',

confirmButtonColor:'#16a34a'

}).then(()=>{

window.location='index.php';

});

</script>

</body>
</html>

<?php

}else{

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Gagal</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data dokter gagal disimpan.',

confirmButtonColor:'#dc2626'

}).then(()=>{

window.history.back();

});

</script>

</body>
</html>

<?php

}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);

?>