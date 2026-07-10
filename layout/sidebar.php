<?php

$current = basename($_SERVER['PHP_SELF']);
$request = $_SERVER['REQUEST_URI'];

$isDashboard = $current === 'index.php' && !preg_match('#/(pasien|dokter|obat|layanan|pemeriksaan|pembayaran|laporan|pengaturan)/#', $request);
$isPasien = strpos($request, '/pasien/') !== false;
$isDokter = strpos($request, '/dokter/') !== false;
$isObat = strpos($request, '/obat/') !== false;
$isLayanan = strpos($request, '/layanan/') !== false;
$isPemeriksaan = strpos($request, '/pemeriksaan/') !== false;
$isPembayaran = strpos($request, '/pembayaran/') !== false;
$isLaporan = strpos($request, '/laporan/') !== false;
$isPengaturan = strpos($request, '/pengaturan/') !== false;

?>

<aside class="sidebar" aria-label="Sidebar navigasi">
    <div class="sidebar-top">
        <a href="/klinik/index.php" class="brand">
            <div class="brand-icon">
                <i class="fas fa-hospital"></i>
            </div>

            <div class="brand-text">
                <h3><?= htmlspecialchars(strtoupper($settings['nama_klinik'])); ?></h3>
                <small>Management System</small>
            </div>
        </a>

        <div class="profile-card">
            <div class="profile-avatar">
                <i class="fas fa-user-shield"></i>
            </div>

            <div class="profile-info">
                <h5>Administrator</h5>
                <span><i class="fas fa-circle"></i> Online</span>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-title">MENU UTAMA</li>
            <li>
                <a href="/klinik/index.php" class="<?= $isDashboard ? 'active' : '' ?>">
                    <i class="fas fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-title">MASTER DATA</li>
            <li>
                <a href="/klinik/pasien/index.php" class="<?= $isPasien ? 'active' : '' ?>">
                    <i class="fas fa-user-injured"></i>
                    <span>Data Pasien</span>
                </a>
            </li>
            <li>
                <a href="/klinik/dokter/index.php" class="<?= $isDokter ? 'active' : '' ?>">
                    <i class="fas fa-user-doctor"></i>
                    <span>Data Dokter</span>
                </a>
            </li>
            <li>
                <a href="/klinik/obat/index.php" class="<?= $isObat ? 'active' : '' ?>">
                    <i class="fas fa-pills"></i>
                    <span>Data Obat</span>
                </a>
            </li>
            <li>
                <a href="/klinik/layanan/index.php" class="<?= $isLayanan ? 'active' : '' ?>">
                    <i class="fas fa-notes-medical"></i>
                    <span>Data Layanan</span>
                </a>
            </li>

            <li class="menu-title">TRANSAKSI</li>
            <li>
                <a href="/klinik/pemeriksaan/index.php" class="<?= $isPemeriksaan ? 'active' : '' ?>">
                    <i class="fas fa-stethoscope"></i>
                    <span>Pemeriksaan</span>
                </a>
            </li>
            <li>
                <a href="/klinik/pembayaran/index.php" class="<?= $isPembayaran ? 'active' : '' ?>">
                    <i class="fas fa-money-check-dollar"></i>
                    <span>Pembayaran</span>
                </a>
            </li>

            <li class="menu-title">LAPORAN</li>
            <li>
                <a href="/klinik/laporan/index.php" class="<?= $isLaporan ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-divider"></div>

        <a href="/klinik/pengaturan/index.php" class="footer-link <?= $isPengaturan ? 'active' : '' ?>">
            <i class="fas fa-gear"></i>
            <span>Pengaturan</span>
        </a>

        <a href="/klinik/auth/logout.php" class="footer-link logout">
            <i class="fas fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>

        <div class="sidebar-version">
            <strong>Version 3.0</strong>
            <small>&copy; <?= date('Y'); ?> <?= htmlspecialchars($settings['nama_klinik']); ?></small>
        </div>
    </div>
</aside>
