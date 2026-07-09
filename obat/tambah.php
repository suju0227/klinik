<?php
include "../config/koneksi.php";
include "../layout/header.php";
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

<i class="fas fa-pills"></i>

Tambah Data Obat

</h3>

<small>Silakan lengkapi data obat di bawah ini.</small>

</div>

<div class="card-body p-4">

<form action="simpan.php" method="POST">

<div class="mb-3">

<label class="form-label">

Nama Obat

</label>

<input
type="text"
name="nama_obat"
class="form-control"
placeholder="Masukkan Nama Obat"
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
placeholder="Contoh : Tablet, Kapsul, Sirup"
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
placeholder="Masukkan Jumlah Stok"
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
placeholder="Masukkan Harga"
required>

<small class="text-muted">

Masukkan harga tanpa titik atau koma.

</small>

</div>

<div class="d-flex justify-content-between mt-4">

<a href="index.php" class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button type="submit" class="btn btn-warning">

<i class="fas fa-save"></i>

Simpan Data

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