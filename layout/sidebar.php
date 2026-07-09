<?php

$current = basename($_SERVER['PHP_SELF']);
$request = $_SERVER['REQUEST_URI'];

?>

<div class="sidebar">

    <!-- ===========================
            LOGO
    ============================ -->

    <div class="sidebar-top">

        <a href="/klinik/index.php" class="brand">

            <div class="brand-icon">

                <i class="fas fa-hospital"></i>

            </div>

            <div class="brand-text">

                <h3><?= strtoupper($settings['nama_klinik']); ?></h3>

                <small>Management System</small>

            </div>

        </a>

        <!-- ===========================
                PROFILE
        ============================ -->

        <div class="profile-card">

            <div class="profile-avatar">

                <i class="fas fa-user-shield"></i>

            </div>

            <div class="profile-info">

                <h5>Administrator</h5>

                <span>

                    <i class="fas fa-circle"></i>

                    Online

                </span>

            </div>

        </div>

        <!-- ===========================
                MENU
        ============================ -->

        <ul class="sidebar-menu">

            <li class="menu-title">

                MENU UTAMA

            </li>

            <!-- ===========================
        DASHBOARD
=========================== -->

<li>

    <a href="/klinik/index.php"

    class="<?= ($current=="index.php" && strpos($request,'pasien')===false && strpos($request,'dokter')===false && strpos($request,'obat')===false && strpos($request,'layanan')===false && strpos($request,'pemeriksaan')===false && strpos($request,'pembayaran')===false && strpos($request,'laporan')===false) ? 'active' : '' ?>">

        <i class="fas fa-house"></i>

        <span>Dashboard</span>

    </a>

</li>

<!-- ===========================
        MASTER DATA
=========================== -->

<li class="menu-title">

    MASTER DATA

</li>

<li>

    <a href="/klinik/pasien/index.php"

    class="<?= strpos($request,'pasien')!==false ? 'active' : '' ?>">

        <i class="fas fa-user-injured"></i>

        <span>Data Pasien</span>

    </a>

</li>

<li>

    <a href="/klinik/dokter/index.php"

    class="<?= strpos($request,'dokter')!==false ? 'active' : '' ?>">

        <i class="fas fa-user-doctor"></i>

        <span>Data Dokter</span>

    </a>

</li>

<li>

    <a href="/klinik/obat/index.php"

    class="<?= strpos($request,'obat')!==false ? 'active' : '' ?>">

        <i class="fas fa-pills"></i>

        <span>Data Obat</span>

    </a>

</li>

<li>

    <a href="/klinik/layanan/index.php"

    class="<?= strpos($request,'layanan')!==false ? 'active' : '' ?>">

        <i class="fas fa-notes-medical"></i>

        <span>Data Layanan</span>

    </a>

</li>

<!-- ===========================
        TRANSAKSI
=========================== -->

<li class="menu-title">

    TRANSAKSI

</li>

<li>

    <a href="/klinik/pemeriksaan/index.php"

    class="<?= strpos($request,'pemeriksaan')!==false ? 'active' : '' ?>">

        <i class="fas fa-stethoscope"></i>

        <span>Pemeriksaan</span>

    </a>

</li>

<li>

    <a href="/klinik/pembayaran/index.php"

    class="<?= strpos($request,'pembayaran')!==false ? 'active' : '' ?>">

        <i class="fas fa-money-check-dollar"></i>

        <span>Pembayaran</span>

    </a>

</li>

<!-- ===========================
        LAPORAN
=========================== -->

<li class="menu-title">

    LAPORAN

</li>

<li>

    <a href="/klinik/laporan/index.php"

    class="<?= strpos($request,'laporan')!==false ? 'active' : '' ?>">

        <i class="fas fa-chart-line"></i>

        <span>Laporan</span>

    </a>

</li>
        <!-- ===========================
                FOOTER SIDEBAR
        ============================ -->

        </ul>

    </div>

    <div class="sidebar-footer">

        <div class="sidebar-divider"></div>

        <a href="/klinik/pengaturan/index.php" class="footer-link">

            <i class="fas fa-gear"></i>

            <span>Pengaturan</span>

        </a>

        <a href="/klinik/auth/logout.php" class="footer-link logout">

            <i class="fas fa-right-from-bracket"></i>

            <span>Logout</span>

        </a>

        <div class="sidebar-version">

            <strong>Version 3.0</strong>

            <small>

                © <?= date('Y'); ?> Klinik Yakusa

            </small>

        </div>

    </div>

</div>