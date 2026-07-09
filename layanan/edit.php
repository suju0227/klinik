<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($koneksi, "
SELECT *
FROM layanan
WHERE id_layanan='$id'
");

$data = mysqli_fetch_assoc($query);

include "../layout/header.php";
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-warning text-dark">

<h3 class="mb-0">

<i class="fas fa-edit"></i>

Edit Data Layanan

</h3>

<small>

Ubah informasi layanan pemeriksaan.

</small>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input
type="hidden"
name="id_layanan"
value="<?= $data['id_layanan']; ?>">

<!-- Nama Layanan -->

<div class="mb-3">

<label class="form-label">

Nama Layanan

</label>

<input
type="text"
name="nama_layanan"
class="form-control"
value="<?= htmlspecialchars($data['nama_layanan']); ?>"
required>

</div>

<!-- Harga -->

<div class="mb-3">

<label class="form-label">

Harga

</label>

<input
type="number"
name="harga"
class="form-control"
value="<?= $data['harga']; ?>"
min="0"
required>

</div>

<!-- Keterangan -->

<div class="mb-3">

<label class="form-label">

Keterangan

</label>

<textarea
name="keterangan"
class="form-control"
rows="4"><?= htmlspecialchars($data['keterangan']); ?></textarea>

</div>

<!-- Tombol -->

<div class="d-flex justify-content-end">

<a href="index.php"
class="btn btn-secondary me-2">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button
type="submit"
class="btn btn-warning">

<i class="fas fa-save"></i>

Update

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<?php include "../layout/footer.php"; ?>