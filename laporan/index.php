<?php
include "../koneksi.php";
include "../layout/header.php";
?>

<div class="wrapper">

    <?php include "../layout/sidebar.php"; ?>

    <div class="main">

        <?php include "../layout/navbar.php"; ?>

        <div class="container-fluid fade-up mt-4">

            <!-- Header -->
            <div class="dashboard-header mb-4">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <h2 class="dashboard-title">
                            <i class="fas fa-chart-line"></i>
                            Laporan Sistem Klinik
                        </h2>

                        <p class="dashboard-subtitle">
                            Cetak seluruh laporan sistem dalam format PDF.
                        </p>

                    </div>

                </div>

            </div>

            <!-- Card Laporan -->

            <div class="row g-4">

                <!-- PASIEN -->

                <div class="col-lg-4 col-md-6">

                    <div class="card report-card shadow-sm border-0">

                        <div class="card-body text-center">

                            <div class="report-icon bg-primary">

                                <i class="fas fa-user-injured"></i>

                            </div>

                            <h4 class="mt-3">Data Pasien</h4>

                            <p class="text-muted">

                                Cetak seluruh data pasien.

                            </p>

                            <a href="cetak_pasien.php"
                               target="_blank"
                               class="btn btn-primary">

                                <i class="fas fa-print"></i>

                                Cetak PDF

                            </a>

                        </div>

                    </div>

                </div>

                <!-- DOKTER -->

                <div class="col-lg-4 col-md-6">

                    <div class="card report-card shadow-sm border-0">

                        <div class="card-body text-center">

                            <div class="report-icon bg-success">

                                <i class="fas fa-user-doctor"></i>

                            </div>

                            <h4 class="mt-3">Data Dokter</h4>

                            <p class="text-muted">

                                Cetak seluruh data dokter.

                            </p>

                            <a href="cetak_dokter.php"
                               target="_blank"
                               class="btn btn-success">

                                <i class="fas fa-print"></i>

                                Cetak PDF

                            </a>

                        </div>

                    </div>

                </div>

                <!-- OBAT -->

                <div class="col-lg-4 col-md-6">

                    <div class="card report-card shadow-sm border-0">

                        <div class="card-body text-center">

                            <div class="report-icon bg-warning">

                                <i class="fas fa-pills"></i>

                            </div>

                            <h4 class="mt-3">Data Obat</h4>

                            <p class="text-muted">

                                Cetak seluruh data obat.

                            </p>

                            <a href="cetak_obat.php"
                               target="_blank"
                               class="btn btn-warning text-white">

                                <i class="fas fa-print"></i>

                                Cetak PDF

                            </a>

                        </div>

                    </div>

                </div>

                <!-- PEMERIKSAAN -->

                <div class="col-lg-4 col-md-6">

                    <div class="card report-card shadow-sm border-0">

                        <div class="card-body text-center">

                            <div class="report-icon bg-info">

                                <i class="fas fa-stethoscope"></i>

                            </div>

                            <h4 class="mt-3">Data Pemeriksaan</h4>

                            <p class="text-muted">

                                Cetak seluruh data pemeriksaan.

                            </p>

                            <a href="cetak_pemeriksaan.php"
                               target="_blank"
                               class="btn btn-info text-white">

                                <i class="fas fa-print"></i>

                                Cetak PDF

                            </a>

                        </div>

                    </div>

                </div>

                <!-- PEMBAYARAN -->

                <div class="col-lg-4 col-md-6">

                    <div class="card report-card shadow-sm border-0">

                        <div class="card-body text-center">

                            <div class="report-icon bg-danger">

                                <i class="fas fa-money-check-dollar"></i>

                            </div>

                            <h4 class="mt-3">Data Pembayaran</h4>

                            <p class="text-muted">

                                Cetak seluruh data pembayaran.

                            </p>

                            <a href="cetak_pembayaran.php"
                               target="_blank"
                               class="btn btn-danger">

                                <i class="fas fa-print"></i>

                                Cetak PDF

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include "../layout/footer.php"; ?>