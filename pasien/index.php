<?php
include "../config/koneksi.php";

// Mengambil data pasien
$query = mysqli_query($koneksi, "
SELECT * FROM pasien
ORDER BY id_pasien DESC
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

<i class="fas fa-user-injured"></i>

Data Pasien

</h3>

<small>

Kelola seluruh data pasien klinik

</small>

</div>

<a href="tambah.php" class="btn btn-primary">

<i class="fas fa-plus-circle"></i>

Tambah Pasien

</a>

</div>

<div class="card-body">

<div class="table-responsive">

<table id="tabelPasien" class="table table-hover align-middle">

<thead class="table-success">

<tr>

<th>No</th>

<th>Nama Pasien</th>

<th>Jenis Kelamin</th>

<th>Umur</th>

<th>No HP</th>

<th>Alamat</th>

<th width="170">Aksi</th>

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

<?php

if($data['jenis_kelamin']=="Laki-laki"){

echo "<span class='badge bg-primary'>Laki-laki</span>";

}else{

echo "<span class='badge bg-danger'>Perempuan</span>";

}

?>

</td>

<td>

<strong>

<?= $data['umur']; ?> Tahun

</strong>

</td>

<td>

<?= htmlspecialchars($data['no_hp']); ?>

</td>

<td>

<?= htmlspecialchars($data['alamat']); ?>

</td>

<td>

<a
href="edit.php?id=<?= $data['id_pasien']; ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<button
class="btn btn-danger btn-sm btnHapus"
data-id="<?= $data['id_pasien']; ?>"
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
<?php include "../layout/footer.php"; ?>

<script>

$(document).ready(function(){

    $('#tabelPasien').DataTable({

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

document.querySelectorAll(".btnHapus").forEach(function(btn){

    btn.addEventListener("click",function(){

        let id=this.dataset.id;

        let nama=this.dataset.nama;

        Swal.fire({

            title:"Hapus Data?",

            html:"Yakin ingin menghapus pasien <b>"+nama+"</b> ?",

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