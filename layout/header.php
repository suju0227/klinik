<?php

// Path assets absolut agar include tetap stabil lintas folder.
$basePath = '/klinik/';
$request = $_SERVER['REQUEST_URI'];

if (!isset($pageTitle) || $pageTitle === 'Sistem Manajemen Klinik') {
    $pageTitle = 'Dashboard';

    if (strpos($request, '/pasien/') !== false) {
        $pageTitle = 'Data Pasien';
    } elseif (strpos($request, '/dokter/') !== false) {
        $pageTitle = 'Data Dokter';
    } elseif (strpos($request, '/obat/') !== false) {
        $pageTitle = 'Data Obat';
    } elseif (strpos($request, '/layanan/') !== false) {
        $pageTitle = 'Data Layanan';
    } elseif (strpos($request, '/pemeriksaan/') !== false) {
        $pageTitle = 'Pemeriksaan';
    } elseif (strpos($request, '/pembayaran/') !== false) {
        $pageTitle = 'Pembayaran';
    } elseif (strpos($request, '/laporan/') !== false) {
        $pageTitle = 'Laporan';
    } elseif (strpos($request, '/pengaturan/') !== false) {
        $pageTitle = 'Pengaturan';
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#0d9488">
<title><?= htmlspecialchars($settings['nama_klinik']); ?> - <?= htmlspecialchars($pageTitle); ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">
<link rel="stylesheet" href="<?= $basePath ?>assets/css/sidebar.css">
<link rel="stylesheet" href="<?= $basePath ?>assets/css/navbar.css">
<link rel="stylesheet" href="<?= $basePath ?>assets/css/dashboard.css">
<link rel="stylesheet" href="<?= $basePath ?>assets/css/table.css">
<link rel="stylesheet" href="<?= $basePath ?>assets/css/form.css">
<link rel="stylesheet" href="<?= $basePath ?>assets/css/responsive.css">

<!-- Tailwind CSS Play CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#0d9488',
          primaryHover: '#0f766e',
          secondary: '#10b981',
          slate: {
            50: '#f8fafc',
            100: '#f1f5f9',
            200: '#e2e8f0',
            300: '#cbd5e1',
            400: '#94a3b8',
            500: '#64748b',
            600: '#475569',
            700: '#334155',
            800: '#1e293b',
            900: '#0f172a',
          }
        },
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
        }
      }
    }
  }
</script>
</head>
<body class="app-shell">
