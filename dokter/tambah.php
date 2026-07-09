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

<div class="card-header bg-success text-white rounded-top-4">

<h3 class="mb-0">

<i class="fas fa-user-doctor"></i>

Tambah Data Dokter

</h3>

<small>Silakan lengkapi data dokter di bawah ini.</small>

</div>

<div class="card-body p-4">

<form action="simpan.php" method="POST">

<div class="mb-3">

<label class="form-label">

Nama Dokter

</label>

<input

type="text"

name="nama_dokter"

class="form-control"

placeholder="Masukkan Nama Dokter"

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

placeholder="Contoh : Dokter Umum"

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

placeholder="08xxxxxxxxxx"

required>

</div>

<div class="mb-3">

<label class="form-label">

Alamat

</label>

<textarea

name="alamat"

rows="4"

class="form-control"

placeholder="Masukkan Alamat Dokter"

required></textarea>

</div>

<div class="d-flex justify-content-between mt-4">

<a href="index.php" class="btn btn-secondary px-4">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button type="submit" class="btn btn-success px-4">

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

</div>

<?php include "../layout/footer.php"; ?>