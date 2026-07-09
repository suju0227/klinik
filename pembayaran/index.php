<?php
include "../config/koneksi.php";

$query = mysqli_query($koneksi,"
SELECT
    pembayaran.*,
    pasien.nama_pasien,
    dokter.nama_dokter
FROM pembayaran

LEFT JOIN pemeriksaan
ON pembayaran.id_pemeriksaan = pemeriksaan.id_pemeriksaan

LEFT JOIN pasien
ON pemeriksaan.id_pasien = pasien.id_pasien

LEFT JOIN dokter
ON pemeriksaan.id_dokter = dokter.id_dokter

ORDER BY pembayaran.id_pembayaran DESC
");

include "../layout/header.php";
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-success text-white d-flex justify-content-between align-items-center">

<div>

<h3 class="mb-0">

<i class="fas fa-money-bill-wave"></i>

Data Pembayaran

</h3>

<small>

Kelola seluruh transaksi pembayaran klinik

</small>

</div>

<a href="tambah.php" class="btn btn-dark">

<i class="fas fa-plus-circle"></i>

Tambah Pembayaran

</a>

</div>

<div class="card-body">

<div class="table-responsive">

<table id="tabelPembayaran" class="table table-hover align-middle">

<thead class="table-success">

<tr>

<th>No</th>

<th>Pasien</th>

<th>Dokter</th>

<th>Total Bayar</th>

<th>Metode</th>

<th>Tanggal</th>

<th width="220">Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

while($data = mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td>

<strong>

<?= htmlspecialchars($data['nama_pasien']); ?>

</strong>

</td>

<td>

<?= htmlspecialchars($data['nama_dokter']); ?>

</td>

<td>

<strong>

Rp <?= number_format($data['total_bayar'],0,",","."); ?>

</strong>

</td>

<td>

<span class="badge bg-success">

<?= htmlspecialchars($data['metode_pembayaran']); ?>

</span>

</td>

<td>

<?= date('d-m-Y',strtotime($data['tanggal_bayar'])); ?>

</td>

<td>

<!-- STRUK -->

<a
href="struk.php?id=<?= $data['id_pembayaran']; ?>"
target="_blank"
class="btn btn-info btn-sm"
title="Cetak Struk">

<i class="fas fa-print"></i>

</a>

<!-- EDIT -->

<a
href="edit.php?id=<?= $data['id_pembayaran']; ?>"
class="btn btn-warning btn-sm"
title="Edit">

<i class="fas fa-edit"></i>

</a>

<!-- HAPUS -->

<button
class="btn btn-danger btn-sm btnHapus"
data-id="<?= $data['id_pembayaran']; ?>"
data-nama="<?= htmlspecialchars($data['nama_pasien']); ?>"
title="Hapus">

<i class="fas fa-trash"></i>

</button>

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

$('#tabelPembayaran').DataTable({

responsive:true,

language:{

search:"Cari :",

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

document.querySelectorAll(".btnHapus").forEach(function(btn){

btn.addEventListener("click",function(){

let id=this.dataset.id;

let nama=this.dataset.nama;

Swal.fire({

title:"Hapus Data?",

html:"Yakin ingin menghapus pembayaran <b>"+nama+"</b> ?",

icon:"warning",

showCancelButton:true,

confirmButtonColor:"#dc3545",

cancelButtonColor:"#6c757d",

confirmButtonText:"Ya, Hapus",

cancelButtonText:"Batal"

}).then((result)=>{

if(result.isConfirmed){

window.location="hapus.php?id="+id;

}

});

});

});

</script>