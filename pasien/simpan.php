<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Mengambil data dari form
    $nama_pasien    = trim($_POST['nama_pasien']);
    $jenis_kelamin  = trim($_POST['jenis_kelamin']);
    $umur           = trim($_POST['umur']);
    $alamat         = trim($_POST['alamat']);
    $no_hp          = trim($_POST['no_hp']);

    // Validasi
    if (
        empty($nama_pasien) ||
        empty($jenis_kelamin) ||
        empty($umur) ||
        empty($alamat) ||
        empty($no_hp)
    ) {
        $status = "kosong";
    } else {

        // Prepared Statement
        $stmt = mysqli_prepare(
            $koneksi,
            "INSERT INTO pasien
            (nama_pasien, jenis_kelamin, umur, alamat, no_hp)
            VALUES (?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssiss",
            $nama_pasien,
            $jenis_kelamin,
            $umur,
            $alamat,
            $no_hp
        );

        if (mysqli_stmt_execute($stmt)) {
            $status = "berhasil";
        } else {
            $status = "gagal";
        }

        mysqli_stmt_close($stmt);
    }

} else {

    header("Location:index.php");
    exit;

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Proses Simpan</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php

if($status=="berhasil"){

?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pasien berhasil disimpan.',

confirmButtonColor:'#0d6efd'

}).then(()=>{

window.location='index.php';

});

</script>

<?php

}elseif($status=="kosong"){

?>

<script>

Swal.fire({

icon:'warning',

title:'Data Belum Lengkap',

text:'Silakan isi seluruh data pasien.',

confirmButtonColor:'#f59e0b'

}).then(()=>{

history.back();

});

</script>

<?php

}else{

?>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data pasien gagal disimpan.',

confirmButtonColor:'#dc3545'

}).then(()=>{

history.back();

});

</script>

<?php

}

?>

</body>
</html>