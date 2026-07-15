<?php

$request = $_SERVER['REQUEST_URI'];
$pageTitle = 'Dashboard';
$pageCrumb = 'Home';
$pageLabel = 'Dashboard';
$pageIcon = 'fa-house';

if (strpos($request, '/pasien/') !== false) {
    $pageTitle = 'Data Pasien';
    $pageCrumb = 'Master Data';
    $pageLabel = 'Pasien';
    $pageIcon = 'fa-user-injured';
} elseif (strpos($request, '/dokter/') !== false) {
    $pageTitle = 'Data Dokter';
    $pageCrumb = 'Master Data';
    $pageLabel = 'Dokter';
    $pageIcon = 'fa-user-doctor';
} elseif (strpos($request, '/obat/') !== false) {
    $pageTitle = 'Data Obat';
    $pageCrumb = 'Master Data';
    $pageLabel = 'Obat';
    $pageIcon = 'fa-pills';
} elseif (strpos($request, '/layanan/') !== false) {
    $pageTitle = 'Data Layanan';
    $pageCrumb = 'Master Data';
    $pageLabel = 'Layanan';
    $pageIcon = 'fa-notes-medical';
} elseif (strpos($request, '/pemeriksaan/') !== false) {
    $pageTitle = 'Pemeriksaan';
    $pageCrumb = 'Transaksi';
    $pageLabel = 'Pemeriksaan';
    $pageIcon = 'fa-stethoscope';
} elseif (strpos($request, '/pembayaran/') !== false) {
    $pageTitle = 'Pembayaran';
    $pageCrumb = 'Transaksi';
    $pageLabel = 'Pembayaran';
    $pageIcon = 'fa-money-bill-wave';
} elseif (strpos($request, '/laporan/') !== false) {
    $pageTitle = 'Laporan';
    $pageCrumb = 'Laporan';
    $pageLabel = 'Laporan';
    $pageIcon = 'fa-chart-line';
} elseif (strpos($request, '/pengaturan/') !== false) {
    $pageTitle = 'Pengaturan';
    $pageCrumb = 'Akun';
    $pageLabel = 'Pengaturan';
    $pageIcon = 'fa-gear';
} elseif (strpos($request, '/profile/') !== false) {
    $pageTitle = 'Profil Saya';
    $pageCrumb = 'Akun';
    $pageLabel = 'Profil';
    $pageIcon = 'fa-user-circle';
}

?>

<header class="topbar">
    <div class="topbar-left">
        <button class="toggle-sidebar" id="toggleSidebar" type="button" aria-label="Buka atau tutup sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <div class="page-header">
            <h3><?= htmlspecialchars($pageTitle); ?></h3>

            <div class="breadcrumb-custom">
                <span>
                    <i class="fas <?= htmlspecialchars($pageIcon); ?>"></i>
                    <?= htmlspecialchars($pageCrumb); ?>
                </span>
                <i class="fas fa-angle-right"></i>
                <span class="active"><?= htmlspecialchars($pageLabel); ?></span>
            </div>
        </div>
    </div>

    <div class="topbar-right">
        <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input
                type="text"
                id="globalSearch"
                placeholder="Cari pasien, dokter, obat, layanan...">
            <kbd>Ctrl + K</kbd>
        </div>

        <div class="datetime-box">
            <div class="date-info">
                <i class="fas fa-calendar-days"></i>
                <span id="tanggalNavbar"><?= date('d F Y'); ?></span>
            </div>

            <div class="time-info">
                <i class="fas fa-clock"></i>
                <span id="jamNavbar">00:00:00</span>
            </div>
        </div>

        <div class="notification-box">
            <button class="notification-btn" type="button" aria-label="Notifikasi">
                <i class="far fa-bell"></i>
                <span class="notification-count">3</span>
            </button>
        </div>

        <div class="profile-dropdown">
            <button class="profile-button" type="button" aria-label="Profil pengguna">
                <div class="profile-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>

                <div class="profile-detail">
                    <h6>Administrator</h6>
                    <small>System Administrator</small>
                </div>

                <i class="fas fa-chevron-down arrow-down"></i>
            </button>

            <div class="profile-menu">
                <a href="/klinik/profile/index.php">
                    <i class="fas fa-user"></i>
                    Profil Saya
                </a>

                <a href="/klinik/pengaturan/index.php">
                    <i class="fas fa-gear"></i>
                    Pengaturan
                </a>

                <div class="dropdown-divider"></div>

                <a href="/klinik/auth/logout.php" class="text-danger">
                    <i class="fas fa-right-from-bracket"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const profile = document.querySelector(".profile-dropdown");
    const button = document.querySelector(".profile-button");

    if (!profile || !button) {
        return;
    }

    button.addEventListener("click", function (e) {
        e.stopPropagation();
        profile.classList.toggle("show");
    });

    document.addEventListener("click", function () {
        profile.classList.remove("show");
    });
});
</script>

<script>
function updateNavbarClock() {
    const now = new Date();
    const jam = String(now.getHours()).padStart(2, '0');
    const menit = String(now.getMinutes()).padStart(2, '0');
    const detik = String(now.getSeconds()).padStart(2, '0');
    const el = document.getElementById("jamNavbar");

    if (el) {
        el.innerHTML = jam + ":" + menit + ":" + detik;
    }
}

setInterval(updateNavbarClock, 1000);
updateNavbarClock();
</script>
