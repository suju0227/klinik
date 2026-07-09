<?php
include "../config/koneksi.php";

$query = mysqli_query($koneksi,"
SELECT *
FROM pasien
ORDER BY id_pasien DESC
");

include "../layout/header.php";
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

<div>

<h3 class="mb-0">

<i class="fas fa-file-medical"></i>

Laporan Data Pasien

</h3>

<small>

Laporan seluruh data pasien klinik

</small>

</div>

<div>

<a
href="index.php"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<a
href="cetak_pasien.php"
target="_blank"
class="btn btn-danger">

<i class="fas fa-file-pdf"></i>

Cetak PDF

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table
id="tabelLaporanPasien"
class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>No</th>

<th>Nama Pasien</th>

<th>Jenis Kelamin</th>

<th>Umur</th>

<th>No HP</th>

<th>Alamat</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($data=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td>

<strong>

<?= htmlspecialchars($data['nama_pasien']); ?>

</strong>

</td>

<td>

<?php

if($data['jenis_kelamin']=="Laki-laki"){

echo "<span class='badge bg-primary'>Laki-laki</span>";

}else{

echo "<span class='badge bg-danger'>Perempuan</span>";

}

?>

</td>

<td>

<?= $data['umur']; ?> Tahun

</td>

<td>

<?= htmlspecialchars($data['no_hp']); ?>

</td>

<td>

<?= htmlspecialchars($data['alamat']); ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</div>

<?php include "../layout/footer.php"; ?>

<script>

$(document).ready(function(){

$('#tabelLaporanPasien').DataTable({

responsive:true,

language:{

search:"Cari Pasien :",

lengthMenu:"Tampilkan _MENU_ data",

zeroRecords:"Data tidak ditemukan",

info:"Menampilkan _START_ - _END_ dari _TOTAL_ data",

paginate:{

previous:"←",

next:"→"

}

}

});

});

</script>