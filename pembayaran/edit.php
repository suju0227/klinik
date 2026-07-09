<?php
include "../config/koneksi.php";
include "../layout/header.php";

// Cek ID
if (!isset($_GET['id'])) {
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data pembayaran
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT * FROM pembayaran WHERE id_pembayaran=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if(!$data){
    header("Location:index.php");
    exit;
}

// Ambil data pemeriksaan
$pemeriksaan = mysqli_query($koneksi,"
SELECT
    pemeriksaan.id_pemeriksaan,
    pasien.nama_pasien,
    dokter.nama_dokter,
    pemeriksaan.tanggal_periksa
FROM pemeriksaan

LEFT JOIN pasien
ON pemeriksaan.id_pasien=pasien.id_pasien

LEFT JOIN dokter
ON pemeriksaan.id_dokter=dokter.id_dokter

ORDER BY pasien.nama_pasien ASC
");
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card card-glass shadow border-0 rounded-4">

<div class="card-header bg-success text-white">

<h3 class="mb-0">

<i class="fas fa-money-bill-wave"></i>

Edit Pembayaran

</h3>

<small>Silakan ubah data pembayaran.</small>

</div>

<div class="card-body p-4">

<form action="update.php" method="POST">

<input
type="hidden"
name="id_pembayaran"
value="<?= $data['id_pembayaran']; ?>">

<!-- Pemeriksaan -->

<div class="mb-3">

<label class="form-label">

Pilih Pemeriksaan

</label>

<select
name="id_pemeriksaan"
class="form-select"
required>

<option value="">-- Pilih Pemeriksaan --</option>

<?php while($p=mysqli_fetch_assoc($pemeriksaan)){ ?>

<option
value="<?= $p['id_pemeriksaan']; ?>"
<?= ($p['id_pemeriksaan']==$data['id_pemeriksaan']) ? "selected" : ""; ?>>

<?= htmlspecialchars($p['nama_pasien']); ?>

- Dr.

<?= htmlspecialchars($p['nama_dokter']); ?>

(<?= date('d-m-Y',strtotime($p['tanggal_periksa'])); ?>)

</option>

<?php } ?>

</select>

</div>

<!-- Total Bayar -->

<div class="mb-3">

<label class="form-label">

Total Bayar

</label>

<input
type="number"
name="total_bayar"
class="form-control"
value="<?= $data['total_bayar']; ?>"
required>

</div>

<!-- Metode -->

<div class="mb-3">

<label class="form-label">

Metode Pembayaran

</label>

<select
name="metode_pembayaran"
class="form-select"
required>

<option value="Tunai"
<?= ($data['metode_pembayaran']=="Tunai")?"selected":""; ?>>

Tunai

</option>

<option value="Transfer"
<?= ($data['metode_pembayaran']=="Transfer")?"selected":""; ?>>

Transfer

</option>

<option value="QRIS"
<?= ($data['metode_pembayaran']=="QRIS")?"selected":""; ?>>

QRIS

</option>

</select>

</div>

<!-- Tanggal -->

<div class="mb-3">

<label class="form-label">

Tanggal Pembayaran

</label>

<input
type="date"
name="tanggal_bayar"
class="form-control"
value="<?= $data['tanggal_bayar']; ?>"
required>

</div>

<div class="d-flex justify-content-between mt-4">

<a
href="index.php"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button
type="submit"
class="btn btn-success">

<i class="fas fa-save"></i>

Update Data

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</div>

<?php include "../layout/footer.php"; ?>