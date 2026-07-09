<?php
include "../config/koneksi.php";
include "../layout/header.php";

// Cek apakah ada ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data obat
$stmt = mysqli_prepare($koneksi, "SELECT * FROM obat WHERE id_obat=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");
    exit;
}
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card card-glass shadow border-0 rounded-4">

<div class="card-header bg-success text-white rounded-top-4">

<h3 class="mb-0">

<i class="fas fa-pills"></i>

Edit Data Obat

</h3>

<small>Silakan ubah data obat di bawah ini.</small>

</div>

<div class="card-body p-4">

<form action="update.php" method="POST">

<input
type="hidden"
name="id_obat"
value="<?= $data['id_obat']; ?>">

<div class="mb-3">

<label class="form-label">

Nama Obat

</label>

<input
type="text"
name="nama_obat"
class="form-control"
value="<?= htmlspecialchars($data['nama_obat']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Jenis Obat

</label>

<input
type="text"
name="jenis_obat"
class="form-control"
value="<?= htmlspecialchars($data['jenis_obat']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Stok

</label>

<input
type="number"
name="stok"
class="form-control"
value="<?= $data['stok']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Harga

</label>

<input
type="number"
name="harga"
class="form-control"
value="<?= $data['harga']; ?>"
required>

</div>

<div class="d-flex justify-content-between mt-4">

<a href="index.php" class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button
type="submit"
class="btn btn-warning">

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