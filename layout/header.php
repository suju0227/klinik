<?php

// Menentukan path assets secara absolut untuk menghindari masalah relasi folder dan trailing slash
$basePath = '/klinik/';

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($settings['nama_klinik']); ?> - Sistem Manajemen Klinik</title>

<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<!-- Bootstrap Icons -->

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Google Font -->

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- CSS -->

<link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">

<link rel="stylesheet" href="<?= $basePath ?>assets/css/sidebar.css">

<link rel="stylesheet" href="<?= $basePath ?>assets/css/navbar.css">

<link rel="stylesheet" href="<?= $basePath ?>assets/css/dashboard.css">

<link rel="stylesheet" href="<?= $basePath ?>assets/css/table.css">

<link rel="stylesheet" href="<?= $basePath ?>assets/css/form.css">

<link rel="stylesheet" href="<?= $basePath ?>assets/css/responsive.css">

</head>

<body>
