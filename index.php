<?php
include "config/koneksi.php";

/* =====================================================
   DASHBOARD KLINIK YAKUSA V3
===================================================== */

/* ===========================
   TOTAL DATA
=========================== */

$pasien = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM pasien"));

$dokter = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dokter"));

$layanan = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM layanan"));

$obat = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM obat"));

$pemeriksaan = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM pemeriksaan"));

$pembayaran = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM pembayaran"));

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
   BULAN INI
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

include "layout/header.php";
?>

<div class="wrapper">

    <?php include "layout/sidebar.php"; ?>

    <div class="main">

        <?php include "layout/navbar.php"; ?>

        <div class="container-fluid py-4">
<!-- =====================================================
                HERO BANNER
===================================================== -->

<div class="row mb-4">

    <div class="col-lg-12">

        <div class="hero-dashboard">

            <div class="row align-items-center">

                <!-- ==========================
                     TEXT
                ========================== -->

                <div class="col-lg-8">

                    <span class="hero-badge">

                        <i class="fas fa-heartbeat"></i>

                        Dashboard Administrator

                    </span>

                    <h1 class="hero-title mt-3">

                        Selamat Datang,

                        <br>

                        <span><?= strtoupper($settings['nama_klinik']); ?></span>

                    </h1>

                    <p class="hero-desc">

                        Selamat datang di Sistem Manajemen <?= htmlspecialchars($settings['nama_klinik']); ?>.

                        Kelola data pasien, dokter, layanan, obat,

                        pemeriksaan serta pembayaran melalui

                        dashboard modern yang terintegrasi.

                    </p>

                    <div class="hero-info">

                        <div class="hero-item">

                            <i class="fas fa-user-injured"></i>

                            <div>

                                <h4><?= $pasien ?></h4>

                                <small>Total Pasien</small>

                            </div>

                        </div>

                        <div class="hero-item">

                            <i class="fas fa-stethoscope"></i>

                            <div>

                                <h4><?= $pemeriksaanHariIni ?></h4>

                                <small>Pemeriksaan Hari Ini</small>

                            </div>

                        </div>

                        <div class="hero-item">

                            <i class="fas fa-wallet"></i>

                            <div>

                                <h4>

                                    Rp <?= number_format($pendapatanHariIni,0,",","."); ?>

                                </h4>

                                <small>Pendapatan Hari Ini</small>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- ==========================
                     JAM DIGITAL
                ========================== -->

                <div class="col-lg-4 text-center">

                    <div class="hero-clock">

                        <h5 id="tanggal"></h5>

                        <h1 id="jam"></h1>

                        <hr>

                        <h4>

                            <i class="fas fa-hospital"></i>

                            <?= htmlspecialchars($settings['nama_klinik']); ?>

                        </h4>

                        <p>

                            <?= htmlspecialchars($settings['alamat']); ?>

                        </p>

                        <span class="badge bg-success px-3 py-2">

                            <i class="fas fa-circle"></i>

                            Online

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
                PREMIUM STATISTICS
===================================================== -->

<div class="row g-4 mb-4">

    <!-- ================= PASIEN ================= -->

    <div class="col-xl-2 col-lg-4 col-md-6">

        <div class="stats-card card-pasien">

            <div class="stats-header">

                <div>

                    <span class="stats-label">

                        Total Pasien

                    </span>

                    <h2>

                        <?= $pasien; ?>

                    </h2>

                </div>

                <div class="stats-icon">

                    <i class="fas fa-user-injured"></i>

                </div>

            </div>

            <div class="stats-footer">

                <i class="fas fa-circle-check"></i>

                Data Aktif

            </div>

        </div>

    </div>

    <!-- ================= DOKTER ================= -->

    <div class="col-xl-2 col-lg-4 col-md-6">

        <div class="stats-card card-dokter">

            <div class="stats-header">

                <div>

                    <span class="stats-label">

                        Dokter

                    </span>

                    <h2>

                        <?= $dokter; ?>

                    </h2>

                </div>

                <div class="stats-icon">

                    <i class="fas fa-user-doctor"></i>

                </div>

            </div>

            <div class="stats-footer">

                <i class="fas fa-user-check"></i>

                Siap Bertugas

            </div>

        </div>

    </div>

    <!-- ================= LAYANAN ================= -->

    <div class="col-xl-2 col-lg-4 col-md-6">

        <div class="stats-card card-layanan">

            <div class="stats-header">

                <div>

                    <span class="stats-label">

                        Layanan

                    </span>

                    <h2>

                        <?= $layanan; ?>

                    </h2>

                </div>

                <div class="stats-icon">

                    <i class="fas fa-notes-medical"></i>

                </div>

            </div>

            <div class="stats-footer">

                <i class="fas fa-check-circle"></i>

                Tersedia

            </div>

        </div>

    </div>

    <!-- ================= OBAT ================= -->

    <div class="col-xl-2 col-lg-4 col-md-6">

        <div class="stats-card card-obat">

            <div class="stats-header">

                <div>

                    <span class="stats-label">

                        Obat

                    </span>

                    <h2>

                        <?= $obat; ?>

                    </h2>

                </div>

                <div class="stats-icon">

                    <i class="fas fa-pills"></i>

                </div>

            </div>

            <div class="stats-footer">

                <i class="fas fa-capsules"></i>

                Persediaan

            </div>

        </div>

    </div>

    <!-- ================= PEMERIKSAAN ================= -->

    <div class="col-xl-2 col-lg-4 col-md-6">

        <div class="stats-card card-periksa">

            <div class="stats-header">

                <div>

                    <span class="stats-label">

                        Pemeriksaan

                    </span>

                    <h2>

                        <?= $pemeriksaan; ?>

                    </h2>

                </div>

                <div class="stats-icon">

                    <i class="fas fa-stethoscope"></i>

                </div>

            </div>

            <div class="stats-footer">

                <i class="fas fa-heartbeat"></i>

                Riwayat Pasien

            </div>

        </div>

    </div>

    <!-- ================= PENDAPATAN ================= -->

    <div class="col-xl-2 col-lg-4 col-md-6">

        <div class="stats-card card-pendapatan">

            <div class="stats-header">

                <div>

                    <span class="stats-label">

                        Pendapatan

                    </span>

                    <h4>

                        Rp <?= number_format($totalPendapatan,0,",","."); ?>

                    </h4>

                </div>

                <div class="stats-icon">

                    <i class="fas fa-wallet"></i>

                </div>

            </div>

            <div class="stats-footer">

                <i class="fas fa-chart-line"></i>

                Total Keseluruhan

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
                FINANCIAL SUMMARY & GRAFIK
===================================================== -->

<div class="row mb-4">

    <!-- ==========================================
            RINGKASAN KEUANGAN
    =========================================== -->

    <div class="col-lg-4 mb-4">

        <!-- Pendapatan Hari Ini -->

        <div class="finance-card success mb-4">

            <div class="finance-icon">

                <i class="fas fa-sack-dollar"></i>

            </div>

            <div class="finance-content">

                <small>PENDAPATAN HARI INI</small>

                <h2>

                    Rp <?= number_format($pendapatanHariIni,0,",","."); ?>

                </h2>

                <span>

                    <i class="fas fa-arrow-trend-up"></i>

                    Transaksi Hari Ini

                </span>

            </div>

        </div>

        <!-- Pendapatan Bulan -->

        <div class="finance-card primary mb-4">

            <div class="finance-icon">

                <i class="fas fa-chart-line"></i>

            </div>

            <div class="finance-content">

                <small>PENDAPATAN BULAN INI</small>

                <h2>

                    Rp <?= number_format($pendapatanBulan,0,",","."); ?>

                </h2>

                <span>

                    <i class="fas fa-calendar-check"></i>

                    Bulan <?= date('F Y'); ?>

                </span>

            </div>

        </div>

        <!-- Pemeriksaan Hari Ini -->

        <div class="finance-card danger">

            <div class="finance-icon">

                <i class="fas fa-heart-pulse"></i>

            </div>

            <div class="finance-content">

                <small>PEMERIKSAAN HARI INI</small>

                <h2>

                    <?= $pemeriksaanHariIni; ?>

                </h2>

                <span>

                    <i class="fas fa-user-check"></i>

                    Pasien Dilayani

                </span>

            </div>

        </div>

    </div>

    <!-- ==========================================
                GRAFIK
    =========================================== -->

    <div class="col-lg-8 mb-4">

        <div class="chart-card">

            <div class="chart-header">

                <div>

                    <h4>

                        Grafik Pemeriksaan

                    </h4>

                    <small>

                        Statistik Pemeriksaan Tahun <?= date('Y'); ?>

                    </small>

                </div>

                <div class="chart-badge">

                    <i class="fas fa-chart-column"></i>

                </div>

            </div>

            <div class="chart-body">

                <canvas
                    id="grafikPemeriksaan"
                    height="120">
                </canvas>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
            TIMELINE AKTIVITAS & QUICK MENU
===================================================== -->

<div class="row">

    <!-- ==========================================
            AKTIVITAS TERBARU
    =========================================== -->

    <div class="col-lg-5 mb-4">

        <div class="activity-card">

            <div class="section-title">

                <div>

                    <h4>

                        <i class="fas fa-clock-rotate-left text-success"></i>

                        Aktivitas Terbaru

                    </h4>

                    <small>

                        Riwayat Pemeriksaan Pasien

                    </small>

                </div>

            </div>

            <div class="timeline">

<?php

if(mysqli_num_rows($aktivitas)>0){

while($a=mysqli_fetch_assoc($aktivitas)){

?>

<div class="timeline-item">

    <div class="timeline-icon">

        <i class="fas fa-user-check"></i>

    </div>

    <div class="timeline-content">

        <h6>

            <?= htmlspecialchars($a['nama_pasien']); ?>

        </h6>

        <p>

            Pemeriksaan oleh

            <strong>

                <?= htmlspecialchars($a['nama_dokter']); ?>

            </strong>

        </p>

        <small>

            <?= htmlspecialchars($a['diagnosa']); ?>

        </small>

        <span>

            <i class="fas fa-calendar-days"></i>

            <?= date('d F Y',strtotime($a['tanggal_periksa'])); ?>

        </span>

    </div>

</div>

<?php

}

}else{

?>

<div class="text-center py-5">

<i class="fas fa-folder-open fa-3x text-secondary mb-3"></i>

<h6>

Belum ada aktivitas.

</h6>

</div>

<?php } ?>

            </div>

        </div>

    </div>

    <!-- ==========================================
                QUICK MENU
    =========================================== -->

    <div class="col-lg-7 mb-4">

        <div class="quick-card-container">

            <div class="section-title mb-4">

                <div>

                    <h4>

                        <i class="fas fa-bolt text-warning"></i>

                        Quick Menu

                    </h4>

                    <small>

                        Akses Cepat Menu Utama

                    </small>

                </div>

            </div>

            <div class="row g-4">

                <div class="col-md-4">

                    <a href="pasien/index.php" class="quick-box">

                        <div class="quick-icon bg-primary">

                            <i class="fas fa-user-plus"></i>

                        </div>

                        <h5>Pasien</h5>

                        <p>Kelola Data Pasien</p>

                    </a>

                </div>

                <div class="col-md-4">

                    <a href="dokter/index.php" class="quick-box">

                        <div class="quick-icon bg-success">

                            <i class="fas fa-user-doctor"></i>

                        </div>

                        <h5>Dokter</h5>

                        <p>Kelola Dokter</p>

                    </a>

                </div>

                <div class="col-md-4">

                    <a href="layanan/index.php" class="quick-box">

                        <div class="quick-icon bg-info">

                            <i class="fas fa-notes-medical"></i>

                        </div>

                        <h5>Layanan</h5>

                        <p>Kelola Layanan</p>

                    </a>

                </div>

                <div class="col-md-4">

                    <a href="obat/index.php" class="quick-box">

                        <div class="quick-icon bg-warning">

                            <i class="fas fa-pills"></i>

                        </div>

                        <h5>Obat</h5>

                        <p>Data Obat</p>

                    </a>

                </div>

                <div class="col-md-4">

                    <a href="pemeriksaan/index.php" class="quick-box">

                        <div class="quick-icon bg-danger">

                            <i class="fas fa-stethoscope"></i>

                        </div>

                        <h5>Pemeriksaan</h5>

                        <p>Input Pemeriksaan</p>

                    </a>

                </div>

                <div class="col-md-4">

                    <a href="pembayaran/index.php" class="quick-box">

                        <div class="quick-icon bg-dark">

                            <i class="fas fa-money-bill-wave"></i>

                        </div>

                        <h5>Pembayaran</h5>

                        <p>Transaksi Pembayaran</p>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
        INFORMASI KLINIK
========================================== -->

<div class="row">

    <div class="col-lg-12">

        <div class="clinic-card">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h3>

                        <i class="fas fa-hospital"></i>

                        <?= htmlspecialchars($settings['nama_klinik']); ?>

                    </h3>

                    <p>

                        Sistem Manajemen Klinik modern yang digunakan
                        untuk mengelola pasien, dokter, layanan,
                        pemeriksaan, obat dan pembayaran dalam
                        satu aplikasi terintegrasi.

                    </p>

                </div>

                <div class="col-lg-4">

                    <table class="table table-borderless mb-0">

                        <tr>

                            <td><strong>Alamat</strong></td>

                            <td><?= htmlspecialchars($settings['alamat']); ?></td>

                        </tr>

                        <tr>

                            <td><strong>Telepon</strong></td>

                            <td><?= htmlspecialchars($settings['telepon']); ?></td>

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

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
                FOOTER
===================================================== -->

        </div>
        <!-- End Container -->

    </div>
    <!-- End Main -->

</div>
<!-- End Wrapper -->

<?php include "layout/footer.php"; ?>

<!-- =====================================================
                CHART JS
===================================================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const grafik = document.getElementById('grafikPemeriksaan');

new Chart(grafik,{

    type:'line',

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

            label:'Pemeriksaan',

            data:[<?= $grafik ?>],

            fill:true,

            tension:.4,

            borderWidth:4,

            borderColor:'#16a34a',

            backgroundColor:'rgba(22,163,74,.12)',

            pointRadius:5,

            pointHoverRadius:8,

            pointBackgroundColor:'#16a34a'

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

        interaction:{

            intersect:false,

            mode:'index'

        },

        scales:{

            x:{

                grid:{
                    display:false
                }

            },

            y:{

                beginAtZero:true,

                ticks:{
                    precision:0
                },

                grid:{
                    color:'rgba(0,0,0,.05)'
                }

            }

        }

    }

});

</script>

<!-- =====================================================
                JAM DIGITAL
===================================================== -->

<script>

function updateClock(){

    const now=new Date();

    const jam=String(now.getHours()).padStart(2,'0');

    const menit=String(now.getMinutes()).padStart(2,'0');

    const detik=String(now.getSeconds()).padStart(2,'0');

    document.getElementById("jam").innerHTML=

    jam+":"+menit+":"+detik;

}

setInterval(updateClock,1000);

updateClock();

</script>

<!-- =====================================================
                TANGGAL INDONESIA
===================================================== -->

<script>

const hari=[

"Minggu",

"Senin",

"Selasa",

"Rabu",

"Kamis",

"Jumat",

"Sabtu"

];

const bulan=[

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

const sekarang=new Date();

document.getElementById("tanggal").innerHTML=

hari[sekarang.getDay()]+" , "+

sekarang.getDate()+" "+

bulan[sekarang.getMonth()]+" "+

sekarang.getFullYear();

</script>

</body>

</html>