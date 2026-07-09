<?php
include "../config/koneksi.php";
include "../layout/header.php";

// Cek ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data dokter
$stmt = mysqli_prepare($koneksi, "SELECT * FROM dokter WHERE id_dokter=?");
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

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-warning text-dark rounded-top-4">

<h3 class="mb-0">

<i class="fas fa-user-doctor"></i>

Edit Data Dokter

</h3>

<small>Silakan ubah data dokter.</small>

</div>

<div class="card-body p-4">

<form action="update.php" method="POST">

<input
type="hidden"
name="id_dokter"
value="<?= $data['id_dokter']; ?>">

<div class="mb-3">

<label class="form-label">

Nama Dokter

</label>

<input
type="text"
name="nama_dokter"
class="form-control"
value="<?= htmlspecialchars($data['nama_dokter']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Spesialis

</label>

<input
type="text"
name="spesialis"
class="form-control"
value="<?= htmlspecialchars($data['spesialis']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Nomor HP

</label>

<input
type="text"
name="no_hp"
class="form-control"
value="<?= htmlspecialchars($data['no_hp']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Alamat

</label>

<textarea
name="alamat"
class="form-control"
rows="4"
required><?= htmlspecialchars($data['alamat']); ?></textarea>

</div>

<div class="d-flex justify-content-between">

<a href="index.php" class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button type="submit" class="btn btn-warning">

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