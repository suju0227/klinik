<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form
    $id_pasien      = trim($_POST['id_pasien']);
    $nama_pasien    = trim($_POST['nama_pasien']);
    $jenis_kelamin  = trim($_POST['jenis_kelamin']);
    $umur           = trim($_POST['umur']);
    $alamat         = trim($_POST['alamat']);
    $no_hp          = trim($_POST['no_hp']);

    // Validasi
    if (
        empty($id_pasien) ||
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
            "UPDATE pasien
             SET nama_pasien=?,
                 jenis_kelamin=?,
                 umur=?,
                 alamat=?,
                 no_hp=?
             WHERE id_pasien=?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssissi",
            $nama_pasien,
            $jenis_kelamin,
            $umur,
            $alamat,
            $no_hp,
            $id_pasien
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
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Update Data Pasien</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pasien berhasil diperbarui.',

confirmButtonColor:'#198754'

}).then(()=>{

window.location='index.php';

});

</script>

<?php } elseif($status=="kosong"){ ?>

<script>

Swal.fire({

icon:'warning',

title:'Data Belum Lengkap',

text:'Silakan lengkapi seluruh data pasien.',

confirmButtonColor:'#ffc107'

}).then(()=>{

history.back();

});

</script>

<?php } else { ?>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data pasien gagal diperbarui.',

confirmButtonColor:'#dc3545'

}).then(()=>{

history.back();

});

</script>

<?php } ?>

</body>
</html>