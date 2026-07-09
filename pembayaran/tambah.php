<?php
include "../config/koneksi.php";
include "../layout/header.php";

// Ambil data pemeriksaan
$pemeriksaan = mysqli_query($koneksi,"
SELECT
    pemeriksaan.id_pemeriksaan,
    pasien.nama_pasien,
    dokter.nama_dokter,
    pemeriksaan.tanggal_periksa
FROM pemeriksaan

LEFT JOIN pasien
ON pemeriksaan.id_pasien = pasien.id_pasien

LEFT JOIN dokter
ON pemeriksaan.id_dokter = dokter.id_dokter

ORDER BY pemeriksaan.id_pemeriksaan DESC
");
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

<i class="fas fa-money-bill-wave"></i>

Tambah Pembayaran

</h3>

<small>

Silakan pilih pemeriksaan pasien.

</small>

</div>

<div class="card-body p-4">

<form action="simpan.php" method="POST">

<!-- ===========================
PILIH PEMERIKSAAN
=========================== -->

<div class="mb-3">

<label class="form-label">

Pilih Pemeriksaan

</label>

<select
name="id_pemeriksaan"
id="id_pemeriksaan"
class="form-select"
required>

<option value="">-- Pilih Pemeriksaan --</option>

<?php while($p=mysqli_fetch_assoc($pemeriksaan)){ ?>

<option value="<?= $p['id_pemeriksaan']; ?>">

<?= htmlspecialchars($p['nama_pasien']); ?>

- Dr.

<?= htmlspecialchars($p['nama_dokter']); ?>

(<?= date('d-m-Y',strtotime($p['tanggal_periksa'])); ?>)

</option>

<?php } ?>

</select>

</div>

<!-- ===========================
DAFTAR LAYANAN
=========================== -->

<div class="mb-3">

<label class="form-label">

Rincian Layanan

</label>

<div
id="listLayanan"
class="border rounded p-3 bg-light">

<center class="text-muted">

Pilih pemeriksaan terlebih dahulu

</center>

</div>

</div>

<!-- ===========================
TOTAL BAYAR
=========================== -->

<div class="mb-3">

<label class="form-label">

Total Pembayaran

</label>

<input
type="text"
id="total"
class="form-control fw-bold"
readonly>

<input
type="hidden"
name="total_bayar"
id="total_hidden">

</div>

<!-- ===========================
METODE
=========================== -->

<div class="mb-3">

<label class="form-label">

Metode Pembayaran

</label>

<select
name="metode_pembayaran"
class="form-select"
required>

<option value="">-- Pilih Metode --</option>

<option value="Tunai">Tunai</option>

<option value="Transfer">Transfer</option>

<option value="QRIS">QRIS</option>

</select>

</div>

<!-- ===========================
TANGGAL
=========================== -->

<div class="mb-3">

<label class="form-label">

Tanggal Pembayaran

</label>

<input
type="date"
name="tanggal_bayar"
class="form-control"
value="<?= date('Y-m-d'); ?>"
required>

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
class="btn btn-success">

<i class="fas fa-save"></i>

Simpan Pembayaran

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</div>

<script>

document.getElementById("id_pemeriksaan").addEventListener("change", function(){

let id = this.value;

if(id=="")
{
    document.getElementById("listLayanan").innerHTML =
    "<center class='text-muted'>Pilih pemeriksaan terlebih dahulu</center>";

    document.getElementById("total").value="";

    document.getElementById("total_hidden").value="";

    return;
}

fetch("get_layanan.php?id_pemeriksaan="+id)

.then(response=>response.json())

.then(data=>{

let html="";

if(data.layanan.length==0)
{
    html="<center class='text-danger'>Belum ada layanan.</center>";
}
else
{
    data.layanan.forEach(function(item){

        html += `
        <div class="d-flex justify-content-between border-bottom py-2">

            <div>

                <strong>${item.nama_layanan}</strong><br>

                <small>

                    Rp ${parseInt(item.harga).toLocaleString('id-ID')}
                    x ${item.jumlah}

                </small>

            </div>

            <div>

                <strong>

                    Rp ${parseInt(item.subtotal).toLocaleString('id-ID')}

                </strong>

            </div>

        </div>
        `;

    });
}

document.getElementById("listLayanan").innerHTML = html;

document.getElementById("total").value =
"Rp " + parseInt(data.total).toLocaleString('id-ID');

document.getElementById("total_hidden").value = data.total;

});

});

</script>

<?php include "../layout/footer.php"; ?>