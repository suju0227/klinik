<?php
include "../config/koneksi.php";
include "../layout/header.php";

// Cek ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data pemeriksaan
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT * FROM pemeriksaan WHERE id_pemeriksaan=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");
    exit;
}

// Ambil data pasien
$pasien = mysqli_query(
    $koneksi,
    "SELECT * FROM pasien ORDER BY nama_pasien ASC"
);

// Ambil data dokter
$dokter = mysqli_query(
    $koneksi,
    "SELECT * FROM dokter ORDER BY nama_dokter ASC"
);
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

<i class="fas fa-stethoscope"></i>

Edit Pemeriksaan

</h3>

<small>Silakan ubah data pemeriksaan.</small>

</div>

<div class="card-body p-4">

<form action="update.php" method="POST">

<input
type="hidden"
name="id_pemeriksaan"
value="<?= $data['id_pemeriksaan']; ?>">

<!-- Pasien -->
<div class="mb-3">

<label class="form-label">

Nama Pasien

</label>

<select
name="id_pasien"
class="form-select"
required>

<option value="">-- Pilih Pasien --</option>

<?php while($p=mysqli_fetch_assoc($pasien)){ ?>

<option
value="<?= $p['id_pasien']; ?>"
<?= ($p['id_pasien']==$data['id_pasien']) ? 'selected' : ''; ?>>

<?= htmlspecialchars($p['nama_pasien']); ?>

</option>

<?php } ?>

</select>

</div>

<!-- Dokter -->
<div class="mb-3">

<label class="form-label">

Nama Dokter

</label>

<select
name="id_dokter"
class="form-select"
required>

<option value="">-- Pilih Dokter --</option>

<?php while($d=mysqli_fetch_assoc($dokter)){ ?>

<option
value="<?= $d['id_dokter']; ?>"
<?= ($d['id_dokter']==$data['id_dokter']) ? 'selected' : ''; ?>>

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
value="<?= $data['tanggal_periksa']; ?>"
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
required><?= htmlspecialchars($data['keluhan']); ?></textarea>

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
required><?= htmlspecialchars($data['diagnosa']); ?></textarea>

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
class="btn btn-info text-white">

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