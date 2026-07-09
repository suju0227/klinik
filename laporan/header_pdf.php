<?php

function headerPDF($pdf, $judul)
{
    // ==========================================
    // UKURAN HALAMAN OTOMATIS
    // ==========================================

    $pageWidth = $pdf->GetPageWidth();

    // Margin kiri & kanan
    $margin = 10;

    // Lebar area cetak
    $contentWidth = $pageWidth - ($margin * 2);

    // ==========================================
    // LOGO
    // ==========================================

    $logo = "../assets/img/logo.png";

    if(file_exists($logo))
    {
        $pdf->Image($logo,12,10,22);
    }

    // ==========================================
    // NAMA KLINIK
    // ==========================================

    $pdf->SetFont('Arial','B',18);

    $pdf->Cell(
        $contentWidth,
        8,
        'KLINIK YAKUSA',
        0,
        1,
        'C'
    );

    $pdf->SetFont('Arial','',11);

    $pdf->Cell(
        $contentWidth,
        6,
        'Sistem Manajemen Klinik',
        0,
        1,
        'C'
    );

    $pdf->SetFont('Arial','',10);

    $pdf->Cell(
        $contentWidth,
        5,
        'Jl. Imam Inlu Amal No.1947',
        0,
        1,
        'C'
    );

    $pdf->Cell(
        $contentWidth,
        5,
        'Telp. 0856-5619-1731',
        0,
        1,
        'C'
    );

    // ==========================================
    // GARIS PEMBATAS
    // ==========================================

    $pdf->Ln(2);

    $y = $pdf->GetY();

    $pdf->SetDrawColor(0,0,0);

    $pdf->SetLineWidth(0.6);

    $pdf->Line(
        $margin,
        $y,
        $pageWidth-$margin,
        $y
    );

    $pdf->Line(
        $margin,
        $y+1,
        $pageWidth-$margin,
        $y+1
    );

    // ==========================================
    // JUDUL LAPORAN
    // ==========================================

    $pdf->Ln(6);

    $pdf->SetFont('Arial','B',15);

    $pdf->Cell(
        $contentWidth,
        8,
        strtoupper($judul),
        0,
        1,
        'C'
    );

    // ==========================================
    // TANGGAL CETAK
    // ==========================================

    $bulan = [
        1=>"Januari",
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

    $tanggal =
        date('d')
        ." ".
        $bulan[(int)date('m')]
        ." ".
        date('Y');

    $pdf->SetFont('Arial','',10);

    $pdf->Cell(
        $contentWidth,
        6,
        "Tanggal Cetak : ".$tanggal,
        0,
        1,
        'R'
    );

    $pdf->Ln(4);

}
?>