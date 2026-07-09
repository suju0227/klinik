<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Ambil data
$id_pemeriksaan    = intval($_POST['id_pemeriksaan']);
$total_bayar       = intval($_POST['total_bayar']);
$metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran']);
$tanggal_bayar     = $_POST['tanggal_bayar'];

// Validasi
if ($id_pemeriksaan == 0 || $total_bayar <= 0) {
    $status = "gagal";
} else {

    // Cek apakah pemeriksaan sudah pernah dibayar
    $cek = mysqli_query($koneksi,"
        SELECT *
        FROM pembayaran
        WHERE id_pemeriksaan='$id_pemeriksaan'
    ");

    if(mysqli_num_rows($cek)>0){

        $status = "sudah";

    }else{

        $stmt = mysqli_prepare(
            $koneksi,
            "INSERT INTO pembayaran
            (id_pemeriksaan,total_bayar,metode_pembayaran,tanggal_bayar)
            VALUES(?,?,?,?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "iiss",
            $id_pemeriksaan,
            $total_bayar,
            $metode_pembayaran,
            $tanggal_bayar
        );

        if(mysqli_stmt_execute($stmt)){
            $status="berhasil";
        }else{
            $status="gagal";
        }

        mysqli_stmt_close($stmt);

    }

}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Simpan Pembayaran</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Pembayaran Berhasil',

text:'Data pembayaran berhasil disimpan.',

confirmButtonColor:'#198754'

}).then(()=>{

window.location='index.php';

});

</script>

<?php }elseif($status=="sudah"){ ?>

<script>

Swal.fire({

icon:'warning',

title:'Sudah Dibayar',

text:'Pemeriksaan ini sudah memiliki data pembayaran.',

confirmButtonColor:'#ffc107'

}).then(()=>{

window.history.back();

});

</script>

<?php }else{ ?>

<script>

Swal.fire({

icon:'error',

title:'Gagal',

text:'Data pembayaran gagal disimpan.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.history.back();

});

</script>

<?php } ?>

</body>
</html>