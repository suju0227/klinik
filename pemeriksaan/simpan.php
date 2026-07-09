<?php
include "../config/koneksi.php";

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Ambil data form
$id_pasien       = intval($_POST['id_pasien']);
$id_dokter       = intval($_POST['id_dokter']);
$tanggal_periksa = $_POST['tanggal_periksa'];
$keluhan         = htmlspecialchars($_POST['keluhan']);
$diagnosa        = htmlspecialchars($_POST['diagnosa']);

// Layanan yang dipilih
$layanan = isset($_POST['layanan']) ? $_POST['layanan'] : [];

mysqli_begin_transaction($koneksi);

try{

    // ===============================
    // SIMPAN KE TABEL PEMERIKSAAN
    // ===============================

    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO pemeriksaan
        (id_pasien,id_dokter,tanggal_periksa,keluhan,diagnosa)
        VALUES(?,?,?,?,?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "iisss",
        $id_pasien,
        $id_dokter,
        $tanggal_periksa,
        $keluhan,
        $diagnosa
    );

    mysqli_stmt_execute($stmt);

    // Ambil ID pemeriksaan yang baru dibuat
    $id_pemeriksaan = mysqli_insert_id($koneksi);

    mysqli_stmt_close($stmt);

    // ===============================
    // SIMPAN KE DETAIL PEMERIKSAAN
    // ===============================

    if(!empty($layanan)){

        $detail = mysqli_prepare(
            $koneksi,
            "INSERT INTO detail_pemeriksaan
            (id_pemeriksaan,id_layanan,jumlah)
            VALUES(?,?,1)"
        );

        foreach($layanan as $id_layanan){

            $id_layanan = intval($id_layanan);

            mysqli_stmt_bind_param(
                $detail,
                "ii",
                $id_pemeriksaan,
                $id_layanan
            );

            mysqli_stmt_execute($detail);

        }

        mysqli_stmt_close($detail);

    }

    // Semua berhasil
    mysqli_commit($koneksi);

    $status="berhasil";

}catch(Exception $e){

    mysqli_rollback($koneksi);

    $status="gagal";

}

mysqli_close($koneksi);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Simpan Pemeriksaan</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php if($status=="berhasil"){ ?>

<script>

Swal.fire({

icon:'success',

title:'Berhasil',

text:'Data pemeriksaan berhasil disimpan.',

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

text:'Data pemeriksaan gagal disimpan.',

confirmButtonColor:'#dc3545'

}).then(()=>{

window.history.back();

});

</script>

<?php } ?>

</body>
</html>