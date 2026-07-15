<?php
include "../config/koneksi.php";

// Status dari proses ganti password
$status = isset($_GET['status']) ? $_GET['status'] : '';

// ============================================================
// DATA STATISTIK UNTUK PROFILE
// ============================================================
$total_pasien   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM pasien"))[0] ?? 0;
$total_dokter   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM dokter"))[0] ?? 0;
$total_transaksi = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM pembayaran"))[0] ?? 0;
$total_pemeriksaan = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM pemeriksaan"))[0] ?? 0;

// Aktivitas terbaru
$aktivitas = [];

$q_pasien = mysqli_query($koneksi, "SELECT nama_pasien, 'Pasien Baru' as jenis FROM pasien ORDER BY id_pasien DESC LIMIT 3");
while($r = mysqli_fetch_assoc($q_pasien)) { $aktivitas[] = ['ikon'=>'fa-user-injured','warna'=>'teal','label'=>$r['jenis'],'info'=>$r['nama_pasien']]; }

$q_pemeriksaan = mysqli_query($koneksi, "
    SELECT p.nama_pasien, pm.tanggal_periksa
    FROM pemeriksaan pm
    JOIN pasien p ON pm.id_pasien = p.id_pasien
    ORDER BY pm.id_pemeriksaan DESC LIMIT 3
");
while($r = mysqli_fetch_assoc($q_pemeriksaan)) {
    $aktivitas[] = ['ikon'=>'fa-stethoscope','warna'=>'blue','label'=>'Pemeriksaan','info'=>$r['nama_pasien'].' — '.date('d M Y', strtotime($r['tanggal_periksa']))];
}

// Urutkan berdasarkan urutan masuk (cukup 5 terbaru)
$aktivitas = array_slice($aktivitas, 0, 5);

// Tanggal hari ini
$bulan_indo = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$tgl_sekarang = date('d') . ' ' . $bulan_indo[(int)date('m')] . ' ' . date('Y');

include "../layout/header.php";
?>

<div class="wrapper">
    <?php include "../layout/sidebar.php"; ?>

    <div class="main">
        <?php include "../layout/navbar.php"; ?>

        <div class="container-fluid py-4" id="profile-page">

            <!-- ================================================
                 HERO CARD PROFIL
            ================================================ -->
            <div class="profile-hero-card mb-4">
                <div class="profile-hero-bg"></div>
                <div class="profile-hero-content">
                    <div class="profile-hero-avatar">
                        <img src="/klinik/assets/img/logo_klinik.jpg" alt="Logo Klinik" class="hero-logo-img">
                        <span class="avatar-status-badge">
                            <i class="fas fa-circle"></i> Online
                        </span>
                    </div>
                    <div class="profile-hero-info">
                        <h2><?= htmlspecialchars($settings['nama_klinik']) ?></h2>
                        <p class="profile-hero-role">
                            <i class="fas fa-shield-halved"></i>
                            System Administrator
                        </p>
                        <div class="profile-hero-meta">
                            <span><i class="fas fa-envelope"></i> <?= htmlspecialchars($settings['email']) ?></span>
                            <span><i class="fas fa-phone"></i> <?= htmlspecialchars($settings['telepon']) ?></span>
                            <span><i class="fas fa-clock"></i> <?= htmlspecialchars($settings['jam_buka']) ?> – <?= htmlspecialchars($settings['jam_tutup']) ?> WIT</span>
                        </div>
                    </div>
                    <div class="profile-hero-actions">
                        <a href="/klinik/pengaturan/index.php" class="btn-hero-outline">
                            <i class="fas fa-gear"></i> Pengaturan
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-4">

                <!-- ================================================
                     KOLOM KIRI
                ================================================ -->
                <div class="col-lg-4">

                    <!-- Info Klinik -->
                    <div class="profile-info-card mb-4">
                        <div class="profile-info-header">
                            <i class="fas fa-hospital"></i>
                            <h6>Informasi Klinik</h6>
                        </div>
                        <ul class="profile-info-list">
                            <li>
                                <span class="info-label"><i class="fas fa-tag"></i> Nama</span>
                                <span class="info-value"><?= htmlspecialchars($settings['nama_klinik']) ?></span>
                            </li>
                            <li>
                                <span class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat</span>
                                <span class="info-value"><?= htmlspecialchars($settings['alamat']) ?></span>
                            </li>
                            <li>
                                <span class="info-label"><i class="fas fa-phone"></i> Telepon</span>
                                <span class="info-value"><?= htmlspecialchars($settings['telepon']) ?></span>
                            </li>
                            <li>
                                <span class="info-label"><i class="fas fa-envelope"></i> Email</span>
                                <span class="info-value"><?= htmlspecialchars($settings['email']) ?></span>
                            </li>
                            <li>
                                <span class="info-label"><i class="fas fa-clock"></i> Jam Operasional</span>
                                <span class="info-value"><?= htmlspecialchars($settings['jam_buka']) ?> – <?= htmlspecialchars($settings['jam_tutup']) ?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- Info Sistem -->
                    <div class="profile-info-card">
                        <div class="profile-info-header">
                            <i class="fas fa-server"></i>
                            <h6>Informasi Sistem</h6>
                        </div>
                        <ul class="profile-info-list">
                            <li>
                                <span class="info-label"><i class="fas fa-code-branch"></i> Versi</span>
                                <span class="info-value"><span class="badge-version">v3.0</span></span>
                            </li>
                            <li>
                                <span class="info-label"><i class="fas fa-database"></i> Database</span>
                                <span class="info-value">MySQL / db_klinik</span>
                            </li>
                            <li>
                                <span class="info-label"><i class="fas fa-calendar"></i> Tanggal</span>
                                <span class="info-value"><?= $tgl_sekarang ?></span>
                            </li>
                            <li>
                                <span class="info-label"><i class="fas fa-circle-check"></i> Status</span>
                                <span class="info-value"><span class="badge-active">Aktif</span></span>
                            </li>
                        </ul>
                    </div>

                </div>

                <!-- ================================================
                     KOLOM KANAN
                ================================================ -->
                <div class="col-lg-8">

                    <!-- STATISTIK -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="stat-mini-card teal">
                                <div class="stat-mini-icon"><i class="fas fa-user-injured"></i></div>
                                <div class="stat-mini-body">
                                    <h3><?= number_format($total_pasien) ?></h3>
                                    <small>Pasien</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-mini-card blue">
                                <div class="stat-mini-icon"><i class="fas fa-user-doctor"></i></div>
                                <div class="stat-mini-body">
                                    <h3><?= number_format($total_dokter) ?></h3>
                                    <small>Dokter</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-mini-card purple">
                                <div class="stat-mini-icon"><i class="fas fa-stethoscope"></i></div>
                                <div class="stat-mini-body">
                                    <h3><?= number_format($total_pemeriksaan) ?></h3>
                                    <small>Pemeriksaan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-mini-card green">
                                <div class="stat-mini-icon"><i class="fas fa-money-bill-wave"></i></div>
                                <div class="stat-mini-body">
                                    <h3><?= number_format($total_transaksi) ?></h3>
                                    <small>Transaksi</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AKTIVITAS TERBARU -->
                    <div class="profile-info-card mb-4">
                        <div class="profile-info-header">
                            <i class="fas fa-bolt"></i>
                            <h6>Aktivitas Terbaru</h6>
                        </div>
                        <div class="aktivitas-list">
                            <?php if(empty($aktivitas)): ?>
                            <div class="aktivitas-empty">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada aktivitas</p>
                            </div>
                            <?php else: ?>
                            <?php foreach($aktivitas as $ak): ?>
                            <div class="aktivitas-item">
                                <div class="aktivitas-icon <?= $ak['warna'] ?>">
                                    <i class="fas <?= $ak['ikon'] ?>"></i>
                                </div>
                                <div class="aktivitas-body">
                                    <span class="aktivitas-label"><?= htmlspecialchars($ak['label']) ?></span>
                                    <span class="aktivitas-info"><?= htmlspecialchars($ak['info']) ?></span>
                                </div>
                                <div class="aktivitas-dot"></div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- GANTI PASSWORD -->
                    <div class="profile-info-card">
                        <div class="profile-info-header">
                            <i class="fas fa-key"></i>
                            <h6>Keamanan Akun</h6>
                        </div>
                        <form id="formPassword" action="ganti_password.php" method="POST">
                            <div class="row g-3 p-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Password Saat Ini</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" name="password_lama" id="passwordLama" placeholder="Masukkan password saat ini">
                                        <button type="button" class="input-group-text btn-toggle-pass" data-target="passwordLama">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Password Baru</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
                                        <input type="password" class="form-control" name="password_baru" id="passwordBaru" placeholder="Password baru">
                                        <button type="button" class="input-group-text btn-toggle-pass" data-target="passwordBaru">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-shield-halved"></i></span>
                                        <input type="password" class="form-control" name="password_konfirmasi" id="passwordKonfirmasi" placeholder="Ulangi password baru">
                                        <button type="button" class="input-group-text btn-toggle-pass" data-target="passwordKonfirmasi">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Indikator Kekuatan -->
                                <div class="col-12">
                                    <div class="password-strength-bar" id="strengthBar">
                                        <div class="strength-fill" id="strengthFill"></div>
                                    </div>
                                    <small class="strength-label" id="strengthLabel">Masukkan password baru</small>
                                </div>

                                <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                                    <button type="reset" class="btn btn-light px-4">
                                        <i class="fas fa-rotate-left"></i> Reset
                                    </button>
                                    <button type="submit" class="btn-save-pass">
                                        <i class="fas fa-floppy-disk"></i> Simpan Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div><!-- /col-lg-8 -->
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /main -->
</div><!-- /wrapper -->

<?php include "../layout/footer.php"; ?>

<style>
/* ============================================================
   PROFILE PAGE STYLES
============================================================ */

/* Hero Card */
.profile-hero-card {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    background: var(--surface);
    border: 1px solid var(--border-strong);
    box-shadow: var(--shadow-soft);
}

.profile-hero-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #0d9488 0%, #0f766e 40%, #134e4a 100%);
    opacity: 0.92;
    z-index: 0;
}

.profile-hero-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.profile-hero-content {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 28px;
    padding: 32px 36px;
    flex-wrap: wrap;
}

.profile-hero-avatar {
    position: relative;
    flex-shrink: 0;
}

.hero-logo-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255,255,255,0.4);
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
}

.avatar-status-badge {
    position: absolute;
    bottom: 4px;
    right: 4px;
    background: #22c55e;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    border: 2px solid #fff;
    white-space: nowrap;
}

.avatar-status-badge i { font-size: 7px; }

.profile-hero-info {
    flex: 1;
    min-width: 200px;
}

.profile-hero-info h2 {
    color: #fff;
    font-size: 26px;
    font-weight: 800;
    margin: 0 0 6px;
    letter-spacing: -0.5px;
}

.profile-hero-role {
    color: rgba(255,255,255,0.8);
    font-size: 14px;
    margin: 0 0 14px;
}

.profile-hero-role i { margin-right: 6px; }

.profile-hero-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}

.profile-hero-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
    color: rgba(255,255,255,0.85);
    font-size: 13px;
    background: rgba(255,255,255,0.1);
    padding: 5px 12px;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.15);
}

.profile-hero-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-left: auto;
}

.btn-hero-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #fff;
    border: 2px solid rgba(255,255,255,0.5);
    background: rgba(255,255,255,0.1);
    padding: 10px 22px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(4px);
    white-space: nowrap;
}

.btn-hero-outline:hover {
    background: rgba(255,255,255,0.25);
    border-color: #fff;
    color: #fff;
    transform: translateY(-2px);
}

/* Info Card */
.profile-info-card {
    background: var(--surface);
    border: 1px solid var(--border-strong);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-soft);
}

.profile-info-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 22px;
    border-bottom: 1px solid var(--border-strong);
    background: var(--slate-50);
}

.profile-info-header i {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #0d9488, #0f766e);
    color: #fff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.profile-info-header h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: var(--slate-800);
}

.profile-info-list {
    list-style: none;
    margin: 0;
    padding: 6px 0;
}

.profile-info-list li {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    padding: 13px 22px;
    border-bottom: 1px solid var(--slate-100);
    transition: background 0.2s;
}

.profile-info-list li:last-child { border-bottom: none; }
.profile-info-list li:hover { background: var(--slate-50); }

.info-label {
    display: flex;
    align-items: center;
    gap: 7px;
    color: var(--slate-500);
    font-size: 13px;
    font-weight: 500;
    white-space: nowrap;
    min-width: 110px;
}

.info-label i { color: #0d9488; font-size: 12px; }

.info-value {
    color: var(--slate-800);
    font-size: 13px;
    font-weight: 600;
    text-align: right;
}

.badge-version {
    background: linear-gradient(135deg, #0d9488, #0f766e);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
}

.badge-active {
    background: rgba(34,197,94,0.1);
    color: #16a34a;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    border: 1px solid rgba(34,197,94,0.2);
}

/* Stat Mini Cards */
.stat-mini-card {
    background: var(--surface);
    border: 1px solid var(--border-strong);
    border-radius: 18px;
    padding: 18px 16px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: var(--shadow-soft);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.stat-mini-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

.stat-mini-icon {
    width: 46px;
    height: 46px;
    min-width: 46px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #fff;
}

.stat-mini-card.teal .stat-mini-icon  { background: linear-gradient(135deg, #0d9488, #0f766e); }
.stat-mini-card.blue .stat-mini-icon  { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.stat-mini-card.purple .stat-mini-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.stat-mini-card.green .stat-mini-icon  { background: linear-gradient(135deg, #22c55e, #16a34a); }

.stat-mini-body h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 800;
    color: var(--slate-800);
    line-height: 1;
}

.stat-mini-body small {
    color: var(--slate-500);
    font-size: 12px;
    font-weight: 500;
}

/* Aktivitas */
.aktivitas-list { padding: 8px 0; }

.aktivitas-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 13px 22px;
    border-bottom: 1px solid var(--slate-100);
    transition: background 0.2s;
}

.aktivitas-item:last-child { border-bottom: none; }
.aktivitas-item:hover { background: var(--slate-50); }

.aktivitas-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    color: #fff;
}

.aktivitas-icon.teal  { background: linear-gradient(135deg, #0d9488, #0f766e); }
.aktivitas-icon.blue  { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.aktivitas-icon.purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.aktivitas-icon.green  { background: linear-gradient(135deg, #22c55e, #16a34a); }

.aktivitas-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.aktivitas-label {
    font-size: 12px;
    font-weight: 700;
    color: #0d9488;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.aktivitas-info {
    font-size: 13px;
    font-weight: 500;
    color: var(--slate-700);
}

.aktivitas-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--slate-300);
}

.aktivitas-empty {
    text-align: center;
    padding: 32px;
    color: var(--slate-400);
}

.aktivitas-empty i { font-size: 40px; display: block; margin-bottom: 10px; }

/* Password */
.password-strength-bar {
    height: 6px;
    background: var(--slate-200);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 6px;
}

.strength-fill {
    height: 100%;
    width: 0;
    border-radius: 10px;
    transition: width 0.4s ease, background 0.4s ease;
}

.strength-label {
    color: var(--slate-500);
    font-size: 12px;
}

.btn-save-pass {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #0d9488, #0f766e);
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 14px rgba(13,148,136,0.3);
}

.btn-save-pass:hover {
    background: linear-gradient(135deg, #0f766e, #115e59);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(13,148,136,0.4);
}

/* Responsive */
@media (max-width: 768px) {
    .profile-hero-content { flex-direction: column; text-align: center; padding: 24px 20px; }
    .profile-hero-actions { margin-left: 0; width: 100%; }
    .btn-hero-outline { justify-content: center; }
    .profile-hero-meta { justify-content: center; }
}
</style>

<script>
// ============================================================
// TOGGLE SHOW/HIDE PASSWORD
// ============================================================
document.querySelectorAll('.btn-toggle-pass').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var targetId = this.getAttribute('data-target');
        var input = document.getElementById(targetId);
        var icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});

// ============================================================
// PASSWORD STRENGTH METER
// ============================================================
document.getElementById('passwordBaru').addEventListener('input', function() {
    var val = this.value;
    var fill = document.getElementById('strengthFill');
    var label = document.getElementById('strengthLabel');
    var score = 0;

    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    var pct  = ['0%', '25%', '50%', '75%', '100%'][score];
    var clr  = ['#ef4444', '#f97316', '#eab308', '#22c55e', '#0d9488'][score];
    var txt  = ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'][score];

    fill.style.width      = pct;
    fill.style.background = clr;
    label.textContent     = val.length ? txt : 'Masukkan password baru';
    label.style.color     = val.length ? clr : '';
});

// ============================================================
// FORM PASSWORD SUBMIT VALIDATION
// ============================================================
document.getElementById('formPassword').addEventListener('submit', function(e) {
    var lama    = document.getElementById('passwordLama').value.trim();
    var baru    = document.getElementById('passwordBaru').value.trim();
    var konfirm = document.getElementById('passwordKonfirmasi').value.trim();

    if (!lama || !baru || !konfirm) {
        e.preventDefault();
        Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Semua kolom password harus diisi!', confirmButtonColor: '#0d9488' });
        return;
    }

    if (baru.length < 6) {
        e.preventDefault();
        Swal.fire({ icon: 'warning', title: 'Password Terlalu Pendek', text: 'Password baru minimal 6 karakter.', confirmButtonColor: '#0d9488' });
        return;
    }

    if (baru !== konfirm) {
        e.preventDefault();
        Swal.fire({ icon: 'error', title: 'Password Tidak Cocok', text: 'Password baru dan konfirmasi tidak sama!', confirmButtonColor: '#dc3545' });
        return;
    }
});
</script>

<?php if ($status === 'berhasil'): ?>
<script>
Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Password berhasil diperbarui.', confirmButtonColor: '#0d9488' });
</script>
<?php elseif ($status === 'tidak_cocok'): ?>
<script>
Swal.fire({ icon: 'error', title: 'Gagal', text: 'Password baru dan konfirmasi tidak cocok!', confirmButtonColor: '#dc3545' });
</script>
<?php elseif ($status === 'salah_lama'): ?>
<script>
Swal.fire({ icon: 'error', title: 'Password Salah', text: 'Password saat ini yang Anda masukkan salah.', confirmButtonColor: '#dc3545' });
</script>
<?php elseif ($status === 'terlalu_pendek'): ?>
<script>
Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Password baru minimal 6 karakter.', confirmButtonColor: '#f59e0b' });
</script>
<?php elseif ($status === 'kosong'): ?>
<script>
Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Semua kolom password harus diisi.', confirmButtonColor: '#f59e0b' });
</script>
<?php elseif ($status === 'gagal'): ?>
<script>
Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan saat menyimpan password.', confirmButtonColor: '#dc3545' });
</script>
<?php endif; ?>
