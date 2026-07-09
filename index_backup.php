<?php
include "config/koneksi.php";

/* =====================================================
   DASHBOARD PREMIUM KLINIK YAKUSA
   BAGIAN 1A
===================================================== */

/* ===========================
   TOTAL DATA
=========================== */

$pasien = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM pasien")
);

$dokter = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM dokter")
);

$obat = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM obat")
);

$layanan = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM layanan")
);

$pemeriksaan = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM pemeriksaan")
);

$pembayaran = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM pembayaran")
);

/* ===========================
   TOTAL PENDAPATAN
=========================== */

$qPendapatan = mysqli_query(
    $koneksi,
    "SELECT IFNULL(SUM(total_bayar),0) AS total
     FROM pembayaran"
);

$dataPendapatan = mysqli_fetch_assoc($qPendapatan);

$totalPendapatan = $dataPendapatan['total'];

/* ===========================
   PENDAPATAN HARI INI
=========================== */

$qHariIni = mysqli_query(
    $koneksi,
    "SELECT IFNULL(SUM(total_bayar),0) AS total
     FROM pembayaran
     WHERE tanggal_bayar = CURDATE()"
);

$dataHariIni = mysqli_fetch_assoc($qHariIni);

$pendapatanHariIni = $dataHariIni['total'];

/* ===========================
   PENDAPATAN BULAN INI
=========================== */

$qBulan = mysqli_query(
    $koneksi,
    "SELECT IFNULL(SUM(total_bayar),0) AS total
     FROM pembayaran
     WHERE MONTH(tanggal_bayar)=MONTH(CURDATE())
     AND YEAR(tanggal_bayar)=YEAR(CURDATE())"
);

$dataBulan = mysqli_fetch_assoc($qBulan);

$pendapatanBulan = $dataBulan['total'];

/* ===========================
   PEMERIKSAAN HARI INI
=========================== */

$qPeriksaHari = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM pemeriksaan
     WHERE tanggal_periksa = CURDATE()"
);

$dataPeriksaHari = mysqli_fetch_assoc($qPeriksaHari);

$pemeriksaanHariIni = $dataPeriksaHari['total'];

/* ===========================
   GRAFIK PEMERIKSAAN
=========================== */

$grafik = [];

for($i=1;$i<=12;$i++)
{

    $bulan = sprintf("%02d",$i);

    $query = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS total
         FROM pemeriksaan
         WHERE MONTH(tanggal_periksa)='$bulan'
         AND YEAR(tanggal_periksa)=YEAR(CURDATE())"
    );

    $hasil = mysqli_fetch_assoc($query);

    $grafik[] = $hasil['total'];

}

$grafik = implode(",",$grafik);

/* ===========================
   AKTIVITAS TERBARU
=========================== */

$aktivitas = mysqli_query(
    $koneksi,
    "SELECT
        pasien.nama_pasien,
        dokter.nama_dokter,
        pemeriksaan.tanggal_periksa,
        pemeriksaan.diagnosa

     FROM pemeriksaan

     LEFT JOIN pasien
     ON pemeriksaan.id_pasien = pasien.id_pasien

     LEFT JOIN dokter
     ON pemeriksaan.id_dokter = dokter.id_dokter

     ORDER BY pemeriksaan.id_pemeriksaan DESC

     LIMIT 5"
);

include "layout/header.php";
?>

<div class="wrapper">

<?php include "layout/sidebar.php"; ?>

<div class="main">

<?php include "layout/navbar.php"; ?>

<div class="container-fluid py-4 fade-up">

<!-- ==========================================
WELCOME BANNER
========================================== -->

<div class="dashboard-header shadow-lg rounded-4">

<div class="row align-items-center">

<div class="col-lg-8">

<h2 class="dashboard-title">

👋 Selamat Datang,
Administrator

</h2>

<p class="dashboard-subtitle">

Selamat datang di
<b>Sistem Manajemen Klinik Yakusa</b>.

Kelola seluruh data pasien,
dokter,
layanan,
obat,
pemeriksaan,
dan pembayaran
dalam satu dashboard modern.

</p>

</div>

<div class="col-lg-4 text-end">

<h5 id="tanggal"></h5>

<h1 id="jam"></h1>

</div>

</div>

</div>

<!-- ==========================================
STATISTIK DASHBOARD
========================================== -->

<div class="row mt-4">
    <!-- ===========================
TOTAL PASIEN
=========================== -->

<div class="col-xl-2 col-lg-4 col-md-6 mb-4">

<div class="stats-card blue">

<div class="stats-icon">
<i class="fas fa-user-injured"></i>
</div>

<div class="stats-info">

<h2><?= $pasien; ?></h2>

<p>Total Pasien</p>

<small class="text-success">
<i class="fas fa-arrow-up"></i>
Data Aktif
</small>

</div>

</div>

</div>

<!-- ===========================
TOTAL DOKTER
=========================== -->

<div class="col-xl-2 col-lg-4 col-md-6 mb-4">

<div class="stats-card green">

<div class="stats-icon">
<i class="fas fa-user-doctor"></i>
</div>

<div class="stats-info">

<h2><?= $dokter; ?></h2>

<p>Total Dokter</p>

<small class="text-primary">
<i class="fas fa-user-check"></i>
Siap Bertugas
</small>

</div>

</div>

</div>

<!-- ===========================
TOTAL OBAT
=========================== -->

<div class="col-xl-2 col-lg-4 col-md-6 mb-4">

<div class="stats-card orange">

<div class="stats-icon">
<i class="fas fa-pills"></i>
</div>

<div class="stats-info">

<h2><?= $obat; ?></h2>

<p>Total Obat</p>

<small class="text-warning">
<i class="fas fa-capsules"></i>
Persediaan
</small>

</div>

</div>

</div>

<!-- ===========================
TOTAL LAYANAN
=========================== -->

<div class="col-xl-2 col-lg-4 col-md-6 mb-4">

<div class="stats-card purple">

<div class="stats-icon">
<i class="fas fa-notes-medical"></i>
</div>

<div class="stats-info">

<h2><?= $layanan; ?></h2>

<p>Total Layanan</p>

<small class="text-info">
<i class="fas fa-check-circle"></i>
Tersedia
</small>

</div>

</div>

</div>

<!-- ===========================
TOTAL PEMERIKSAAN
=========================== -->

<div class="col-xl-2 col-lg-4 col-md-6 mb-4">

<div class="stats-card cyan">

<div class="stats-icon">
<i class="fas fa-stethoscope"></i>
</div>

<div class="stats-info">

<h2><?= $pemeriksaan; ?></h2>

<p>Pemeriksaan</p>

<small class="text-danger">
<i class="fas fa-heartbeat"></i>
Riwayat
</small>

</div>

</div>

</div>

<!-- ===========================
TOTAL PENDAPATAN
=========================== -->

<div class="col-xl-2 col-lg-4 col-md-6 mb-4">

<div class="stats-card dark">

<div class="stats-icon">
<i class="fas fa-wallet"></i>
</div>

<div class="stats-info">

<h5 class="mb-1">

Rp <?= number_format($totalPendapatan,0,",","."); ?>

</h5>

<p>Total Pendapatan</p>

<small class="text-success">

<i class="fas fa-chart-line"></i>

Keseluruhan

</small>

</div>

</div>

</div>

</div>

<!-- ===========================
RINGKASAN PENDAPATAN
=========================== -->

<div class="row">

<div class="col-lg-6 mb-4">

<div class="card shadow border-0 rounded-4">

<div class="card-body">

<h5 class="mb-3">

<i class="fas fa-calendar-day text-success"></i>

Pendapatan Hari Ini

</h5>

<h2 class="text-success">

Rp <?= number_format($pendapatanHariIni,0,",","."); ?>

</h2>

<p class="text-muted mb-0">

Akumulasi transaksi pada hari ini.

</p>

</div>

</div>

</div>

<div class="col-lg-6 mb-4">

<div class="card shadow border-0 rounded-4">

<div class="card-body">

<h5 class="mb-3">

<i class="fas fa-calendar-alt text-primary"></i>

Pendapatan Bulan Ini

</h5>

<h2 class="text-primary">

Rp <?= number_format($pendapatanBulan,0,",","."); ?>

</h2>

<p class="text-muted mb-0">

Akumulasi transaksi bulan berjalan.

</p>

</div>

</div>

</div>

</div>

<!-- ===========================
PEMERIKSAAN HARI INI
=========================== -->

<div class="row">

<div class="col-lg-12">

<div class="alert alert-info shadow-sm rounded-4">

<h5 class="mb-1">

<i class="fas fa-hospital-user"></i>

Pemeriksaan Hari Ini

</h5>

<h3 class="mb-0">

<?= $pemeriksaanHariIni; ?>

Pasien

</h3>

</div>

</div>

</div>

<!-- ======================================================
AKHIR BAGIAN 1

BAGIAN 2 DIMULAI DARI SINI
====================================================== -->

<!-- ==========================================
ROW GRAFIK & AKTIVITAS
========================================== -->

<div class="row mt-4">

    <!-- ===========================
         GRAFIK
    ============================ -->

    <div class="col-lg-8 mb-4">

        <div class="card shadow border-0 rounded-4 h-100">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">

                    <i class="fas fa-chart-bar"></i>

                    Grafik Pemeriksaan Tahun <?= date('Y'); ?>

                </h5>

            </div>

            <div class="card-body">

                <canvas
                    id="grafikPemeriksaan"
                    height="110">
                </canvas>

            </div>

        </div>

    </div>

    <!-- ===========================
         AKTIVITAS TERBARU
    ============================ -->

    <div class="col-lg-4 mb-4">

        <div class="card shadow border-0 rounded-4 h-100">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    <i class="fas fa-history"></i>

                    Aktivitas Terbaru

                </h5>

            </div>

            <div class="card-body">

<?php

if(mysqli_num_rows($aktivitas)>0){

while($a=mysqli_fetch_assoc($aktivitas)){

?>

<div class="d-flex mb-3">

<div class="me-3">

<span
class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
style="
width:45px;
height:45px;
">

<i class="fas fa-user-check"></i>

</span>

</div>

<div class="flex-grow-1">

<h6 class="mb-1">

<?= htmlspecialchars($a['nama_pasien']); ?>

</h6>

<p class="mb-1 text-muted">

Pemeriksaan oleh

<strong>

<?= htmlspecialchars($a['nama_dokter']); ?>

</strong>

</p>

<small class="text-secondary">

Diagnosa :

<?= htmlspecialchars($a['diagnosa']); ?>

</small>

<br>

<small class="text-primary">

<i class="fas fa-calendar"></i>

<?= date('d F Y',strtotime($a['tanggal_periksa'])); ?>

</small>

</div>

</div>

<hr>

<?php

}

}else{

?>

<div class="text-center text-muted py-5">

<i class="fas fa-folder-open fa-3x mb-3"></i>

<h6>

Belum ada aktivitas.

</h6>

</div>

<?php } ?>

</div>

</div>

</div>

</div>

<!-- ==========================================
QUICK MENU
========================================== -->

<div class="row">

    <div class="col-lg-8 mb-4">

        <div class="card shadow border-0 rounded-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">

                    <i class="fas fa-bolt"></i>

                    Quick Menu

                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-3">

                        <a href="pasien/index.php" class="quick-menu text-decoration-none">

                            <div class="quick-card bg-primary">

                                <i class="fas fa-user-plus fa-3x mb-3"></i>

                                <h6>Data Pasien</h6>

                            </div>

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="pemeriksaan/index.php" class="quick-menu text-decoration-none">

                            <div class="quick-card bg-info">

                                <i class="fas fa-stethoscope fa-3x mb-3"></i>

                                <h6>Pemeriksaan</h6>

                            </div>

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="pembayaran/index.php" class="quick-menu text-decoration-none">

                            <div class="quick-card bg-success">

                                <i class="fas fa-money-bill-wave fa-3x mb-3"></i>

                                <h6>Pembayaran</h6>

                            </div>

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="laporan/index.php" class="quick-menu text-decoration-none">

                            <div class="quick-card bg-danger">

                                <i class="fas fa-file-pdf fa-3x mb-3"></i>

                                <h6>Laporan</h6>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ======================================
         INFORMASI KLINIK
    ======================================= -->

    <div class="col-lg-4 mb-4">

        <div class="card shadow border-0 rounded-4 h-100">

            <div class="card-header bg-warning">

                <h5 class="mb-0">

                    <i class="fas fa-hospital"></i>

                    Informasi Klinik

                </h5>

            </div>

            <div class="card-body">

                <table class="table table-borderless table-sm">

                    <tr>

                        <td width="35%"><strong>Nama</strong></td>

                        <td>Klinik Yakusa</td>

                    </tr>

                    <tr>

                        <td><strong>Alamat</strong></td>

                        <td>Jl. Imam Inlu Amal No.1947</td>

                    </tr>

                    <tr>

                        <td><strong>Telepon</strong></td>

                        <td>0856-5619-1731</td>

                    </tr>

                    <tr>

                        <td><strong>Jam Buka</strong></td>

                        <td>08.00 - 20.00</td>

                    </tr>

                    <tr>

                        <td><strong>Status</strong></td>

                        <td>

                            <span class="badge bg-success">

                                Aktif

                            </span>

                        </td>

                    </tr>

                </table>

                <hr>

                <div class="text-center">

                    <i class="fas fa-heartbeat text-danger fa-3x mb-2"></i>

                    <h6 class="mb-1">

                        Sistem Manajemen Klinik

                    </h6>

                    <small class="text-muted">

                        Dashboard Administrator

                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ======================================================
AKHIR BAGIAN 2B-1

LANJUT BAGIAN 2B-2
====================================================== -->

<?php include "layout/footer.php"; ?>

<!-- ==========================================
CHART JS
========================================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('grafikPemeriksaan');

new Chart(ctx,{

    type:'bar',

    data:{

        labels:[
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ],

        datasets:[{

            label:'Jumlah Pemeriksaan',

            data:[<?= $grafik ?>],

            backgroundColor:[
                '#0d6efd',
                '#198754',
                '#ffc107',
                '#dc3545',
                '#20c997',
                '#6610f2',
                '#fd7e14',
                '#6f42c1',
                '#0dcaf0',
                '#198754',
                '#ffc107',
                '#0d6efd'
            ],

            borderRadius:8,

            borderWidth:0

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{

                display:false

            }

        },

        scales:{

            y:{

                beginAtZero:true,

                ticks:{

                    precision:0

                }

            }

        }

    }

});

</script>

<!-- ==========================================
JAM DIGITAL
========================================== -->

<script>

function updateClock(){

    const now = new Date();

    const jam = String(now.getHours()).padStart(2,'0');
    const menit = String(now.getMinutes()).padStart(2,'0');
    const detik = String(now.getSeconds()).padStart(2,'0');

    document.getElementById("jam").innerHTML =
        jam + ":" + menit + ":" + detik;

}

setInterval(updateClock,1000);

updateClock();

</script>

<!-- ==========================================
TANGGAL INDONESIA
========================================== -->

<script>

const hari = [
"Minggu",
"Senin",
"Selasa",
"Rabu",
"Kamis",
"Jumat",
"Sabtu"
];

const bulan = [
"Januari",
"Februari",
"Maret",
"April",
"Mei",
"Juni",
"Juli",
"Agustus",
"September",
"Oktober",
"November",
"Desember"
];

const sekarang = new Date();

document.getElementById("tanggal").innerHTML =

hari[sekarang.getDay()] + ", " +

sekarang.getDate() + " " +

bulan[sekarang.getMonth()] + " " +

sekarang.getFullYear();

</script>

</body>
</html>