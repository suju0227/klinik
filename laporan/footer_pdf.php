<?php

function footerPDF($pdf)
{
    // ==========================================
    // FORMAT TANGGAL INDONESIA
    // ==========================================

    $bulan = [
        1 => "Januari",
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

    $tanggal = date('d') . " " .
               $bulan[(int)date('m')] . " " .
               date('Y');

    // ==========================================
    // UKURAN HALAMAN
    // ==========================================

    $pageWidth = $pdf->GetPageWidth();
    $pageHeight = $pdf->GetPageHeight();

    // Posisi footer dimulai 45 mm dari bawah
    $footerY = $pageHeight - 45;

    // Jika posisi sekarang terlalu bawah,
    // pindah halaman baru agar footer tidak terpotong.
    if ($pdf->GetY() > $footerY) {
        $pdf->AddPage();
        $footerY = $pageHeight - 45;
    }

    $pdf->SetY($footerY);

    // ==========================================
    // TANDA TANGAN
    // ==========================================

    $pdf->SetFont('Arial','',10);

    $pdf->Cell($pageWidth - 90);

    $pdf->Cell(80,6,"Makassar, ".$tanggal,0,1,'C');

    $pdf->Cell($pageWidth - 90);

    $pdf->Cell(80,6,"Mengetahui,",0,1,'C');

    $pdf->Cell($pageWidth - 90);

    $pdf->Cell(80,6,"Administrator Klinik",0,1,'C');

    // Ruang tanda tangan
    $pdf->Ln(18);

    $pdf->SetFont('Arial','B',10);

    $pdf->Cell($pageWidth - 90);

    $pdf->Cell(80,6,"( ____________________ )",0,1,'C');

    // ==========================================
    // GARIS PEMBATAS
    // ==========================================

    $pdf->Ln(5);

    $y = $pdf->GetY();

    $pdf->SetDrawColor(170,170,170);

    $pdf->Line(
        10,
        $y,
        $pageWidth - 10,
        $y
    );

    // ==========================================
    // KETERANGAN
    // ==========================================

    $pdf->Ln(2);

    $pdf->SetFont('Arial','I',8);

    $pdf->Cell(
        0,
        5,
        "Dokumen ini dicetak otomatis oleh Sistem Manajemen Klinik Yakusa",
        0,
        1,
        'C'
    );
}
?>