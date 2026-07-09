<?php
include "../config/koneksi.php";
include "../layout/header.php";

// Ambil data pasien
$pasien = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY nama_pasien ASC");

// Ambil data dokter
$dokter = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY nama_dokter ASC");
// Ambil data layanan
$layanan = mysqli_query($koneksi,"
SELECT *
FROM layanan
ORDER BY nama_layanan ASC
");
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-info text-white">

<h3 class="mb-0">

<i class="fas fa-stethoscope"></i>

Tambah Pemeriksaan

</h3>

<small>Silakan isi data pemeriksaan pasien.</small>

</div>

<div class="card-body p-4">

<form action="simpan.php" method="POST">

<!-- Pasien -->
<div class="mb-3">

<label class="form-label">
Nama Pasien
</label>

<select name="id_pasien" class="form-select" required>

<option value="">-- Pilih Pasien --</option>

<?php while($p=mysqli_fetch_assoc($pasien)){ ?>

<option value="<?= $p['id_pasien']; ?>">

<?= htmlspecialchars($p['nama_pasien']); ?>

</option>

<?php } ?>

</select>

</div>

<!-- Dokter -->
<div class="mb-3">

<label class="form-label">
Dokter
</label>

<select name="id_dokter" class="form-select" required>

<option value="">-- Pilih Dokter --</option>

<?php while($d=mysqli_fetch_assoc($dokter)){ ?>

<option value="<?= $d['id_dokter']; ?>">

<?= htmlspecialchars($d['nama_dokter']); ?>

</option>

<?php } ?>

</select>

</div>

<!-- Tanggal -->
<div class="mb-3">

<label class="form-label">

Tanggal Pemeriksaan

</label>

<input
type="date"
name="tanggal_periksa"
class="form-control"
value="<?= date('Y-m-d'); ?>"
required>

</div>

<!-- Keluhan -->
<div class="mb-3">

<label class="form-label">

Keluhan

</label>

<textarea
name="keluhan"
class="form-control"
rows="3"
required></textarea>

</div>

<!-- Diagnosa -->
<div class="mb-3">

<label class="form-label">

Diagnosa

</label>

<textarea
name="diagnosa"
class="form-control"
rows="3"
required></textarea>

</div>
<!-- Layanan Pemeriksaan -->

<div class="mb-4">

<label class="form-label fw-bold">

<i class="fas fa-hand-holding-medical text-primary"></i>

Layanan Pemeriksaan

</label>

<div class="card border rounded-3">

<div class="card-body">

<?php while($l = mysqli_fetch_assoc($layanan)){ ?>

<div class="form-check d-flex justify-content-between align-items-center mb-2">

<div>

<input
class="form-check-input"
type="checkbox"
name="layanan[]"
value="<?= $l['id_layanan']; ?>"
id="layanan<?= $l['id_layanan']; ?>">

<label
class="form-check-label ms-2"
for="layanan<?= $l['id_layanan']; ?>">

<?= htmlspecialchars($l['nama_layanan']); ?>

</label>

</div>

<strong class="text-success">

Rp <?= number_format($l['harga'],0,",","."); ?>

</strong>

</div>

<?php } ?>

</div>

</div>

<small class="text-muted">

Pilih satu atau lebih layanan yang diberikan kepada pasien.

</small>

</div>

<div class="d-flex justify-content-between mt-4">

<a href="index.php" class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button
type="submit"
class="btn btn-info text-white">

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