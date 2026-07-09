<?php
include "../config/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id_obat DESC");

include "../layout/header.php";
?>

<div class="wrapper">

<?php include "../layout/sidebar.php"; ?>

<div class="main">

<?php include "../layout/navbar.php"; ?>

<div class="container-fluid py-4">

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">

<div>

<h3 class="mb-0">

<i class="fas fa-pills"></i>

Data Obat

</h3>

<small>Kelola seluruh data obat klinik</small>

</div>

<a href="tambah.php" class="btn btn-dark">

<i class="fas fa-plus-circle"></i>

Tambah Obat

</a>

</div>

<div class="card-body">

<div class="table-responsive">

<table id="tabelObat" class="table table-hover align-middle">

<thead class="table-warning">

<tr>

<th>No</th>

<th>Nama Obat</th>

<th>Jenis Obat</th>

<th>Stok</th>

<th>Harga</th>

<th width="180">Aksi</th>

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

<strong><?= htmlspecialchars($data['nama_obat']); ?></strong>

</td>

<td>
    <strong><?= htmlspecialchars($data['jenis_obat']); ?></strong>
</td>

<td>
    <strong style="color:black;font-size:18px;">
        <?= $data['stok']; ?>
    </strong>
</td>

<td>

<strong>

Rp <?= number_format($data['harga'],0,",","."); ?>

</strong>

</td>

<td>

<a href="edit.php?id=<?= $data['id_obat']; ?>"

class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<button

class="btn btn-danger btn-sm btnHapus"

data-id="<?= $data['id_obat']; ?>"

data-nama="<?= htmlspecialchars($data['nama_obat']); ?>">

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

$('#tabelObat').DataTable({

responsive:true,

language:{

search:"Cari Obat :",

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

html:"Yakin ingin menghapus <b>"+nama+"</b> ?",

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