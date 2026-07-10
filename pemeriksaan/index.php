<?php
include "../config/koneksi.php";

$query = mysqli_query($koneksi, "
SELECT
    pemeriksaan.*,
    pasien.nama_pasien,
    dokter.nama_dokter
FROM pemeriksaan
LEFT JOIN pasien
ON pemeriksaan.id_pasien = pasien.id_pasien
LEFT JOIN dokter
ON pemeriksaan.id_dokter = dokter.id_dokter
ORDER BY pemeriksaan.id_pemeriksaan DESC
");

include "../layout/header.php";
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="card card-glass shadow border-0">

<div class="card-header bg-success text-white d-flex justify-content-between align-items-center">

<div>

<h3 class="mb-0">
<i class="fas fa-stethoscope"></i>
Data Pemeriksaan
</h3>

<small>Kelola seluruh data pemeriksaan pasien</small>

</div>

<a href="tambah.php" class="btn btn-primary">
<i class="fas fa-plus-circle"></i>
Tambah Pemeriksaan
</a>

</div>

<div class="card-body">

<div class="table-responsive">

<table id="tabelPemeriksaan" class="table table-hover align-middle">

<thead class="table-success">

<tr>

<th>No</th>
<th>Pasien</th>
<th>Dokter</th>
<th>Tanggal</th>
<th>Keluhan</th>
<th>Diagnosa</th>
<th width="170">Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

while($data=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td>
<strong><?= htmlspecialchars($data['nama_pasien']); ?></strong>
</td>

<td>
<strong><?= htmlspecialchars($data['nama_dokter']); ?></strong>
</td>

<td>
<?= date('d-m-Y', strtotime($data['tanggal_periksa'])); ?>
</td>

<td>
<?= htmlspecialchars($data['keluhan']); ?>
</td>

<td>
<?= htmlspecialchars($data['diagnosa']); ?>
</td>

<td>

<a href="edit.php?id=<?= $data['id_pemeriksaan']; ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<button
class="btn btn-danger btn-sm btnHapus"
data-id="<?= $data['id_pemeriksaan']; ?>"
data-nama="<?= htmlspecialchars($data['nama_pasien']); ?>">

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

$('#tabelPemeriksaan').DataTable({

responsive:true,

language:{

search:"Cari :",

lengthMenu:"Tampilkan _MENU_ data",

zeroRecords:"Data tidak ditemukan",

info:"Menampilkan _START_ - _END_ dari _TOTAL_ data"

}

});

});

document.querySelectorAll(".btnHapus").forEach(function(btn){

btn.addEventListener("click",function(){

let id=this.dataset.id;
let nama=this.dataset.nama;

Swal.fire({

title:"Hapus Data?",

html:"Yakin ingin menghapus data pemeriksaan <b>"+nama+"</b> ?",

icon:"warning",

showCancelButton:true,

confirmButtonColor:"#dc3545",

cancelButtonText:"Batal",

confirmButtonText:"Ya, Hapus"

}).then((result)=>{

if(result.isConfirmed){

window.location="hapus.php?id="+id;

}

});

});

});

</script>